<header class="main-header">
    <div class="container gap-5 d-flex align-items-center">
        <div class="logo">
            <img style="width: 150px" src="{{ asset('assets/images/logo.png') }}" alt="">
        </div>
        <nav class="fw-bold fs-5 flex-fill d-flex justify-content-between align-items-center">
            <ul class="gap-3 mb-0 d-flex list-unstyled">
                <li class=""><a class="text-white text-decoration-none" href="/">Home</a></li>
                <li class=""><a class="text-white text-decoration-none" href="/">Order Tracker</a></li>
            </ul>
            <ul class="gap-3 mb-0 d-flex list-unstyled">
                <li class=""><a class="text-white text-decoration-none" href="/">Sign in</a></li>
                <li class=""><a class="text-white text-decoration-none" href="/">Cart</a></li>
            </ul>
        </nav>
    </div>
</header>

<style>
    :root{
        --primary-brown: #5c3311; /* Main brown background */
        --secondary-brown: #8c5835; /* Lighter brown accents */
        --highlight-yellow: #f6d523; /* Bright yellow for highlights */
        --deep-yellow: #d89e0d; /* Deeper golden yellow */
        --rich-red: #cc3333; /* Rich red for pricing text */
        --light-gray: #eaeaea; /* Light background accents */
        --white: #F7FFF7; /* White for text and other details */
    }
    .main-header{
        background-color: var(--primary-brown);
        color: white;
        height: 90px;
        display: flex;
        align-items: center;
    }
</style>

