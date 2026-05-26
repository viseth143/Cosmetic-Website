<nav class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-pink-500">
            Magic Shop
        </h1>
        <ul class="flex gap-6 font-medium">
            <li><a href="{{ route('home') }}" class="hover:text-pink-500">Home</a></li>
            <li><a href="{{ route('shop') }}" class="hover:text-pink-500">Shop All</a></li>
            <li><a href="{{ route('brand') }}" class="hover:text-pink-500">Brand</a></li>
            <li><a href="{{ route('about') }}" class="hover:text-pink-500">About</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-pink-500">Contact</a></li>
        </ul>
        <div class="flex gap-6 font-medium items-center">
            <a href="{{ route('cart') }}" class="hover:text-pink-500">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            @if(Session::get('customer_id') || Session::get('is_admin'))
            <span class="text-pink-500 font-semibold">
                👋 {{ Session::get('customer_name') ?? Session::get('admin_name') }}
            </span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-pink-500 text-red-500 font-semibold">
                    Logout
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="hover:text-pink-500">
                <i class="fa-solid fa-user"></i> Login
            </a>
            @endif
        </div>
    </div>
</nav>