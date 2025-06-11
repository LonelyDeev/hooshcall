@extends('front.layouts.master')
@push('styles')
<style>
    :root {
        --primary: #51c6c5;
        --primary-light: #7cd7d6;
        --primary-dark: #3aa9a8;
        --secondary: #094471;
        --secondary-light: #1a5788;
        --secondary-dark: #06325a;
        --white: #ffffff;
        --light: #f8f9fa;
        --light-gray: #e9ecef;
        --dark-gray: #343a40;
        --text: #2d3436;
        --text-light: #636e72;
    }

    /* Global Styles */
    body {
        font-family: 'Vazirmatn', sans-serif;
        background-color: #f9f9f9;
    }

    a {
        text-decoration: none;
        transition: all 0.3s ease;
    }

    img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Hero Section */
    .blog-hero {
        position: relative;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
        color: var(--white);
        padding: 80px 0;
        margin-bottom: 60px;
        border-radius: 0 0 50% 50% / 60px;
        overflow: hidden;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ asset('assets/front/img/bg/breadcrumb_bg.jpg') }}') center/cover no-repeat;
        opacity: 0.15;
        z-index: 0;
    }

    .blog-hero .container {
        position: relative;
        z-index: 1;
    }

    .hero-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 20px;
        font-size: 14px;
    }

    .hero-breadcrumb a {
        color: var(--primary-light);
        transition: all 0.3s ease;
    }

    .hero-breadcrumb a:hover {
        color: var(--white);
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        position: relative;
    }

    .hero-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: var(--primary);
        margin-top: 15px;
        border-radius: 2px;
    }

    .hero-shapes img {
        position: absolute;
        opacity: 0.1;
        z-index: 0;
    }

    .hero-shapes img:nth-child(1) {
        top: 10%;
        left: 5%;
        animation: float 6s ease-in-out infinite;
    }

    .hero-shapes img:nth-child(2) {
        top: 60%;
        right: 10%;
        animation: float 8s ease-in-out infinite reverse;
    }

    .hero-shapes img:nth-child(3) {
        bottom: 10%;
        left: 20%;
        animation: float 7s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0); }
    }

    /* Main Content */
    .blog-content-wrapper {
        display: grid;
        grid-template-columns: 70% 30%;
        gap: 30px;
        margin-bottom: 60px;
    }

    /* Blog Post */
    .blog-post {
        background: var(--white);
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .post-thumbnail {
        position: relative;
        overflow: hidden;
        max-height: 450px;
    }

    .post-thumbnail img, .post-thumbnail iframe {
        width: 100%;
        border-radius: 0;
        transition: transform 0.5s ease;
    }

    .post-content {
        padding: 30px;
    }

    .post-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--secondary);
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .post-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .post-category {
        background: var(--primary);
        color: var(--white);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .post-category:hover {
        background: var(--secondary);
        color: var(--white);
    }

    /* Sidebar */
    .blog-sidebar {
        position: sticky;
        top: 100px;
    }

    .sidebar-widget {
        background: var(--white);
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 25px;
        margin-bottom: 30px;
    }

    .widget-title {
        position: relative;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--secondary);
        padding-bottom: 10px;
    }

    .widget-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    /* Search Widget */
    .sidebar-search {
        position: relative;
    }

    .sidebar-search input {
        width: 100%;
        padding: 12px 50px 12px 15px;
        border: 2px solid var(--light-gray);
        border-radius: 30px;
        font-family: 'Vazirmatn', sans-serif;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .sidebar-search input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(81, 198, 197, 0.2);
    }

    .sidebar-search button {
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary);
        color: var(--white);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sidebar-search button:hover {
        background: var(--secondary);
    }

    /* Categories Widget */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        margin-bottom: 10px;
        border-bottom: 1px solid var(--light-gray);
        padding-bottom: 10px;
        transition: all 0.3s ease;
    }

    .category-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
        padding-bottom: 0;
    }

    .category-item a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .category-item a:hover {
        color: var(--primary);
        transform: translateX(-5px);
    }

    .category-item i {
        color: var(--primary);
        font-size: 0.8rem;
        margin-left: 5px;
    }

    /* Recent Posts Widget */
    .recent-post {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--light-gray);
    }

    .recent-post:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .recent-post-thumbnail {
        flex: 0 0 70px;
        border-radius: 8px;
        overflow: hidden;
    }

    .recent-post-thumbnail img {
        width: 100%;
        height: 70px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .recent-post:hover .recent-post-thumbnail img {
        transform: scale(1.1);
    }

    .recent-post-content {
        flex: 1;
    }

    .recent-post-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .recent-post-date {
        font-size: 0.8rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Tags Widget */
    .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tag-list li a {
        display: inline-block;
        padding: 5px 12px;
        background: var(--light);
        color: var(--text);
        border-radius: 20px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .tag-list li a:hover {
        background: var(--primary);
        color: var(--white);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .blog-content-wrapper {
            grid-template-columns: 1fr;
        }
        
        .blog-sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .blog-hero {
            padding: 60px 0;
            border-radius: 0 0 25% 25% / 40px;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .post-content {
            padding: 20px;
        }
        
        .post-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .blog-hero {
            padding: 40px 0;
        }
        
        .hero-title {
            font-size: 1.5rem;
        }
        
        .post-meta {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="blog-hero">
        <div class="container">
            <h2 class="hero-title">جزئیات وبلاگ</h2>
            <div class="hero-breadcrumb">
                <a href="/">خانه</a>
                <span>/</span>
                <span>جزئیات وبلاگ</span>
            </div>
        </div>
        <div class="hero-shapes">
            <img src="{{ asset('assets\front\img\images\breadcrumb_shape01.png') }}" alt="">
            <img src="{{ asset('assets\front\img\images\breadcrumb_shape02.png') }}" alt="" class="rightToLeft">
            <img src="{{ asset('assets\front\img\images\breadcrumb_shape03.png') }}" alt="">
            <img src="{{ asset('assets\front\img\images\breadcrumb_shape04.png') }}" alt="">
            <img src="{{ asset('assets\front\img\images\breadcrumb_shape05.png') }}" alt="" class="alltuchtopdown">
        </div>
    </section>

    <!-- Blog Content -->
    <div class="container">
        <div class="blog-content-wrapper">
            <!-- Main Content -->
            <div class="blog-post">
                <div class="post-thumbnail">
                    @if ($post->video)
                        {!! $post->video !!}
                    @else
                        <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                    @endif
                </div>
                <div class="post-content">
                    <h1 class="post-title">{{ $post->title }}</h1>
                    <div class="post-meta">
                        <a href="{{ url('/blog?c=' . $post->categories->first()->slug . '&k=' . request('k')) }}" class="post-category">
                            {{ @$post->categories->first()->name }}
                        </a>
                        <div class="post-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ jDate($post->created_at)->format('%B %d، %Y') }}</span>
                        </div>
                        <div class="post-meta-item">
                            <i class="far fa-comment"></i>
                            <a href="#">دیدگاه</a>
                        </div>
                    </div>
                    <div class="post-body">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Search Widget -->
                <div class="sidebar-widget">
                    <div class="sidebar-search">
                        <form action="{{ url('/blog') }}" method="GET">
                            <input type="text" name="k" value="{{ request('k') }}" placeholder="جستجو...">
                            <input type="hidden" name="c" value="{{ request('c') }}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">دسته‌بندی‌ها</h4>
                    <ul class="category-list">
                        <li class="category-item">
                            <a href="/blog">
                                <span><i class="fas fa-chevron-left"></i> نمایش همه</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            @php $count = DB::table('category_post')->where('category_id', $category->id)->count(); @endphp
                            @if ($count)
                                <li class="category-item">
                                    <a href="{{ url('/blog?c=' . $category->slug . '&k=' . request('k')) }}">
                                        <span><i class="fas fa-chevron-left"></i> {{ $category->name }}</span>
                                        <span class="category-count">{{ $count }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Recent Posts Widget -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">آخرین مطالب</h4>
                    <div class="recent-posts">
                        @foreach ($last_posts as $last)
                            <div class="recent-post">
                                <div class="recent-post-thumbnail">
                                    <a href="{{ route('front.blog.show', $last->slug) }}">
                                        <img src="{{ asset($last->featured_image) }}" alt="{{ $last->title }}">
                                    </a>
                                </div>
                                <div class="recent-post-content">
                                    <h5 class="recent-post-title">
                                        <a href="{{ route('front.blog.show', $last->slug) }}">{{ $last->title }}</a>
                                    </h5>
                                    <div class="recent-post-date">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ jDate($last->created_at)->format('%B %d، %Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tags Widget -->
                @if (count($tags))
                    <div class="sidebar-widget">
                        <h4 class="widget-title">برچسب‌ها</h4>
                        <ul class="tag-list">
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ url('/blog?tag=' . $tag->slug) }}">{{ $tag->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // اسکریپت‌های مورد نیاز
    document.addEventListener('DOMContentLoaded', function() {
        // اضافه کردن افکت‌های انیمیشن به المان‌ها
        const postThumbnail = document.querySelector('.post-thumbnail');
        if (postThumbnail) {
            postThumbnail.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            postThumbnail.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });
</script>
@endpush