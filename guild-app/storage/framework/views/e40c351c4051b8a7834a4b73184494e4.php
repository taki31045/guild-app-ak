<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <?php echo $__env->yieldContent('styles'); ?>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <?php echo $__env->yieldContent('styles'); ?>


    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<style>
    body {
        background-color: #F4EEE0;
    }
    .navbar{
        background-color: #424242;
    }
  .image-container {
    position: relative; /* 基準となるコンテナ */
}

.overlay-image {
    position: absolute;
    top: 40%; /* 画像の上に配置（調整可） */
    left: 55%; /* 水平方向の位置（調整可） */
    transform: translate(-50%, -50%); /* 画像の中央に配置 */

}

.icon-md {
    font-size: 1.5rem;
    vertical-align: middle;
    margin-right: 10px;
}

</style>

<body style="font-family: Georgia, 'Times New Roman', Times, serif; ">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <div class="image-container">
                        <img src="<?php echo e(asset('images/gu ld.png')); ?>" alt="Base Image" class="base-image">
                        <img src="<?php echo e(asset('images/logo-removebg-preview 1.png')); ?>" alt="Overlay Image" class="overlay-image">
                    </div>

                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li> <a href="<?php echo e(route('company.project.on_going')); ?>">On-Going</a></li>
                        <li class="ms-4"> <a href="<?php echo e(route('company.project.list')); ?>">Job list</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        <li><a href="<?php echo e(route('company.contact.with_freelancer', Auth::user()->id)); ?>" class="text-decoration-none text-white"><i class="fa-regular fa-envelope icon-md"></i></a></li>
                        <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                        <?php endif; ?>

                        <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php echo e(Auth::user()->name); ?>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Profile Link -->
                                <a class="dropdown-item" href="<?php echo e(route('company.profile.profile', Auth::user()->id)); ?>">
                                    <?php echo e(__('Profile')); ?>

                                </a>

                                <!-- Contact Link -->
                                <a class="dropdown-item" href="<?php echo e(route('company.contact.contact', Auth::user()->id)); ?>">
                                    <?php echo e(__('Contact')); ?>

                                </a>
                                <hr>
                                <!-- Log Out -->
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH /Users/ujibayashiryunosuke/Desktop/collabrate work/guild/batch9-guild-app/guild-app-final/batch9-guild-app/guild-app/resources/views/layouts/company.blade.php ENDPATH**/ ?>