<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Posts;
use App\Models\PostsCategory;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Vanthao03596\HCVN\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Helpers;

class HomeController extends Controller
{
    private function orderBy(string $key)
    {
        $orderBy = [
            'new' => ['id', 'DESC'],
            'old' => ['id', 'ASC'],
            'sold' => ['sold', 'DESC'],
            'lowPrice' => ['price', 'ASC'],
            'highPrice' => ['price', 'DESC']
        ];
        return isset($orderBy[$key]) ? $orderBy[$key] : $orderBy['new'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(12);
        $productsHot = Product::orderBy('sold', 'DESC')->where('status', 'active')->paginate(8);

        if ($request->ajax()) {
            $html = view('shop.product.list', compact('products'))->render();
            return response()->json($html);
        }
        return view('shop.home', compact('products', 'productsHot'));
    }

    public function about()
    {
        return view('shop.about.index');
    }

    public function contact()
    {
        return view('shop.contact.index');
    }

    public function productSearch(Request $request)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $keyword = $request->keyword;
        $products = Product::orwhere('title', 'like', '%' . $keyword . '%')
            ->orwhere('slug', 'like', '%' . $keyword . '%')
            //->orwhere('description', 'like', '%' . $request->search . '%')
            ->orwhere('price', 'like', '%' . $keyword . '%')
            ->orderBy($orderBy[0], $orderBy[1])
            ->paginate($paginate);
        return view('shop.product.search', compact('products', 'keyword', 'sort', 'paginate'));
    }

    public function productList(Request $request)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $products = Product::orderBy($orderBy[0], $orderBy[1])->where('status', 'active')->paginate($paginate);
        return view('shop.product.index', compact('products', 'paginate', 'sort'));
    }

    public function productDetail($slug)
    {
        $product = Product::getBySlug($slug);

        if ($product == null) {
            return abort(404, 'S???n ph???m kh??ng t???n t???i');
        }

        $related_products = Category::find($product->category_id)->products->take(4);
        return view('shop.product.detail', compact('product', 'related_products'));
    }

    public function productByCategory(Request $request, $slug)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $category = Category::getBySlug($slug);

        if ($category == null) {
            return abort(404, 'Danh m???c s???n ph???m kh??ng t???n t???i');
        }

        $products = $category->products()->orderBy($orderBy[0], $orderBy[1])->where('status', 'active')->paginate($paginate);
        if ($category->parent == null) {
            $children_id = Category::getChildrenIds($category->id);
            $products = Product::whereIn('category_id', $children_id)->orderBy($orderBy[0], $orderBy[1])->where('status', 'active')->paginate($paginate);
        }
        $parent_category = $category->parent;
        return view('shop.product.index', compact('products', 'category', 'parent_category', 'paginate', 'sort'));
    }

    public function postsList()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(5);
        $recent_posts = Posts::all()->random(3);
        $categories = PostsCategory::getParentCategories();
        return view('shop.posts.list', compact('posts', 'recent_posts', 'categories'));
    }

    public function postsDetail($slug)
    {
        $post = Posts::getBySlug($slug);

        if ($post == null) {
            return abort(404, 'B??i vi???t kh??ng t???n t???i');
        }

        $recent_posts = PostsCategory::find($post->category_id)->posts->take(3);
        $categories =  PostsCategory::getParentCategories();
        return view('shop.posts.detail', compact('post', 'recent_posts', 'categories'));
    }

    public function postsByCategory($slug)
    {
        $category = PostsCategory::getBySlug($slug);

        if ($category == null) {
            return abort(404, 'Danh m???c b??i vi???t kh??ng t???n t???i');
        }

        $posts = $category->posts()->paginate(5);
        $recent_posts = Posts::all()->random(3);
        $categories = PostsCategory::getParentCategories();
        return view('shop.posts.list', compact('posts', 'recent_posts', 'categories'));
    }

    public function login()
    {
        return view('shop.user.login');
    }

    public function register()
    {
        return view('shop.user.register');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('shop.user.profile', compact('user'));
    }

    public function checkout()
    {
        $carts = Cart::getCart();

        if (!$carts || $carts->count == 0) {
            return redirect()->route('home');
        }

        if (session('coupon')) {
            $coupon = Voucher::find(session('coupon')['id']);
            if ($coupon && $coupon->time == 0) {
                session()->forget('coupon');
            }
        }

        $user = Auth::user();
        $provinces = Province::get();
        $discount_money = Helpers::getDiscountMoney($carts->total);
        return view('shop.user.checkout', compact('user', 'carts', 'provinces', 'discount_money'));
    }

    public function order(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'firstname' => 'string|required',
                'lastname' => 'string|required',
                'address' => 'string|required',
                'telephone' => 'numeric|required',
                'email' => 'string|required',
                'note' => 'string|nullable',
                'coupon' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Ch??a nh???p th??ng tin thanh to??n', 'type' => 'empty-form'], 400);
            }
            $carts = Cart::getCart();
            if (empty($carts)) {
                return response()->json(['message' => 'Gi??? h??ng tr???ng', 'type' => 'cart-empty'], 400);
            }

            $order = new Order();
            $data = $request->all();
            $full_address = $request->input('address') . ", " . $request->input('ward') . ", " . $request->input('district') . ", " . $request->input('province');
            $data['address'] = $full_address;
            if (session('coupon')) {
                $coupon = Voucher::find(session('coupon')['id']);
                if ($coupon && $coupon->time == 0) {
                    session()->forget('coupon');
                }
            }
            $discount_money = Helpers::getDiscountMoney($carts->total);
            $order['order_number'] = Helpers::generateOrderNumber(Order::count());
            $order['user_id'] = Auth::id();
            $order['address'] = $full_address;
            $order['status'] = 'new';
            $order['discount'] = $discount_money;
            $order->total = $carts->total - $discount_money;
            $order->fill($data)->save();

            $order_items = [];
            foreach ($carts->items as $item) {
                $order_items[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->quantity * $item->product->price,
                ];
            }
            OrderDetail::insert($order_items);

            $carts->status = 'inactive';
            $carts->save();

            if (session('coupon')) {
                $coupon = Voucher::find(session('coupon')['id']);
                if ($coupon) {
                    $currentTime = $coupon->time;
                    $coupon->time = $currentTime > 1 ? $currentTime - 1 : 0;
                    if ($currentTime == 1) $coupon->status = 'inactive';
                    $coupon->save();
                }
            }
            $request->session()->put('order-success', true);
            return response()->json(['message' => 'Successful'], 200);
        }
    }

    public function orderSuccess(Request $request)
    {
        if ($request->session()->has('order-success')) {
            $request->session()->forget('order-success');
            return view('shop.order.success');
        }
        return redirect()->route('list-ordered');
    }

    public function getOrderList()
    {
        $orders = Order::getListOrdered();
        return view('shop.order.list', compact('orders'));
    }

    public function getDetailOrder($id)
    {
        $order = Order::find($id);
        return view('shop.order.detail', compact('order'));
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Voucher::where('code', $request->code)
            ->where('status', 'active')
            ->where('time', '>', 0)
            ->first();

        if (!$coupon) {
            session()->forget('coupon');
            request()->session()->flash('error-coupon', 'M?? phi???u gi???m gi?? kh??ng h???p l???, Vui l??ng th??? l???i');
            return back();
        }
        if ($coupon) {
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value
            ]);
            request()->session()->flash('success-coupon', 'Phi???u gi???m gi?? ???? ???????c ??p d???ng th??nh c??ng');
            return redirect()->back();
        }
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('shop.user.change-password', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'firstname.string' => 'T??n ph???i l?? chu???i k?? t???',
            'firstname.required' => 'T??n kh??ng ???????c b??? tr???ng',
            'firstname.max' => 'T??n kh??ng ???????c v?????t qu?? 100 k?? t???',
            'lastname.string' => 'H??? ph???i l?? chu???i k?? t???',
            'lastname.required' => 'H??? kh??ng ???????c b??? tr???ng',
            'lastname.max' => 'H??? kh??ng ???????c v?????t qu?? 100 k?? t???',
            'address.required' => '?????a ch??? kh??ng ???????c b??? tr???ng',
            'address.string' => '?????a ch??? ph???i l?? chu???i k?? t???',
            'province.required' => 'T???nh kh??ng ???????c b??? tr???ng',
            'province.string' => 'T???nh ph???i l?? chu???i k?? t???',
            'district.required' => 'Qu???n/huy???n kh??ng ???????c b??? tr???ng',
            'district.string' => 'Qu???n/huy???n ph???i l?? chu???i k?? t???',
            'ward.required' => 'Ph?????ng/x?? kh??ng ???????c b??? tr???ng',
            'ward.string' => 'Ph?????ng/x?? ph???i l?? chu???i k?? t???',
            'email.required' => 'Email kh??ng ???????c b??? tr???ng',
            'email.email' => 'Email kh??ng h???p l???',
            'email.unique' => 'Email kh??ng c?? s???n',
            'telephone.required' => 'S??? ??i???n tho???i kh??ng ???????c b??? tr???ng',
            'telephone.string' => 'S??? ??i???n tho???i ph???i l?? chu???i k?? t???',
            'telephone.min' => 'S??? ??i???n tho???i kh??ng ???????c nh??? h??n 10 k?? t???',
            'telephone.max' => 'S??? ??i???n tho???i kh??ng ???????c l???n h??n 10 k?? t???',
        ];

        $this->validate($request, [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'address' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'telephone' => 'required|string|min:10|max:10',
        ], $messages);

        if ($request->email != $user->email) {
            $this->validate($request, ['email' => 'required|email|unique:users,email,' . $user->email], $messages);
        }
        $data = $request->all();

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'C???p nh???t t??i kho???n th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('profile');
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'oldpassword.required' => 'M???t kh???u hi???n t???i kh??ng ???????c b??? tr???ng',
            'oldpassword.string' => 'M???t kh???u hi???n t???i ph???i l?? chu???i k?? t???',
            'password.required' => 'M???t kh???u m???i kh??ng ???????c b??? tr???ng',
            'password.string' => 'M???t kh???u m???i ph???i l?? chu???i k?? t???',
            'password.different' => 'M???t kh???u m???i ph???i kh??c v???i m???t kh???u hi???n t???i',
            'repassword.required' => 'M???t kh???u x??c nh???n kh??ng ???????c b??? tr???ng',
            'repassword.string' => 'M???t kh???u x??c nh???n ph???i l?? chu???i k?? t???',
            'repassword.same' => 'M???t kh???u x??c nh???n ph???i gi???ng v???i m???t kh???u m???i',
        ];

        $this->validate($request, [
            'oldpassword' => ['required', 'string', new MatchOldPassword],
            'password' => 'string|required|different:oldpassword',
            'repassword' => 'string|required|same:password',
        ], $messages);

        $user->password = Hash::make($request->password);
        $status = $user->save();

        if ($status) {
            request()->session()->flash('success', 'C???p nh???t m???t kh???u th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('change-password-profile');
    }

    public function updateAvatar(Request $request)
    {
        $user = User::find(Auth::id());
        $currentAvatar = $user->avatar;
        $messages = [
            'avatar.required' => 'Ch??a ch???n ???nh',
            'avatar.image' => 'T???p tin ph???i l?? ???nh',
            'avatar.mimes' => '?????nh d???nh ???nh kh??ng cho ph??p'
        ];
        $this->validate($request, ['avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|required'], $messages);
        $image = $request->file('avatar');
        $storedPath = $image->move('images/avatar', Str::uuid() . '.' . $image->extension());
        $user->avatar = $storedPath;
        $status = $user->save();
        if ($status) {
            if ($currentAvatar != $storedPath) {
                Storage::delete($currentAvatar);
            }
            request()->session()->flash('success', 'C???p nh???t ???nh ?????i di???n th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('profile');
    }
}
