<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        
    </head>
    <body>

        <style>
            body{
                background-image: url("<?php echo e(asset('images/1.jpg')); ?>");
                background-size: cover;
            }
            a {
    display: block;
    border: solid 3px;
    width: 300px;
    height: 70px;
    margin: 30px;
    text-align: center;
    line-height: 70px; 
    transition: background-color 1s ease-in-out, transform 0.5s ease-in-out;
}

a:hover {
    background-color: rgb(101, 96, 58);
    transform: scale(1.2); /* 中央から拡大 */
}
a:active {
    border-color:  rgb(101, 96, 58);
    color: rgb(101, 96, 58)
}


    
        </style>
        <div class="container" style="margin-top: 400px; margin-left: 230px;">
            <?php if(Route::has('login')): ?>

                <?php if(auth()->guard()->check()): ?>
                    <a
                        href="<?php echo e(route('company.dashboard')); ?>"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                <?php else: ?>
                    <a
                        href="<?php echo e(route('login')); ?>"
                    >
                        Log in
                    </a>
    
                    <?php if(Route::has('register')): ?>
                        <a
                            href="<?php echo e(route('register')); ?>"
                        >
                            Register
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

        <?php endif; ?>
        </div>
       
        
    </body>
</html>
<?php /**PATH /Users/ujibayashiryunosuke/Desktop/collabrate work/guild/batch9-guild-app/guild-app-final/batch9-guild-app/guild-app/resources/views/welcome.blade.php ENDPATH**/ ?>