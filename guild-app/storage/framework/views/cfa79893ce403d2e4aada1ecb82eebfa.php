<?php $__env->startSection('content'); ?>
<style>
    body {
        background-image: url("<?php echo e(asset('images/Ancient-Roman-Colosseum2.jpg')); ?>");
        background-position: center;
    }
    img {
        height: 500px;
        margin-top: 50px;
        box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.8); /* Darker shadow */
    }
    .container{
        background-color: rgba(255, 255, 255, 0.6);
    }
</style>
<div class="container mt-5 rounded-5" style="height: 600px; width: 1000px;">
    <div class="row">
        <div class="col-6">
            <img src="<?php echo e(asset('images/2c0bedefad1bf39d2f262d96d87070e4.jpg')); ?>" class="deep-shadow rounded ms-3" alt="image-login">
        </div>
        <div class="col-6">
            <div class="card ms-4 mt-5 bg-transparent" style="max-width: 500px; margin: auto; border: none;">
                <div class="card-header text-center bg-transparent">
                    <h4 class="text-black"><?php echo e(__('Login')); ?></h4>
                </div>
            
                <div class="card-body mt-5">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
            
                        <!-- Email input -->
                        <div class="mb-4">
                            <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
            
                        <!-- Password input -->
                        <div class="mb-4">
                            <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
            
                        <!-- Remember me checkbox -->
                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                        </div>
            
                        <!-- Buttons -->
                        <div class="">
                            <button type="submit" class="btn btn-secondary w-100">
                                <?php echo e(__('Login')); ?>

                            </button>
                            <?php if(Route::has('password.request')): ?>
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ujibayashiryunosuke/Desktop/collabrate work/guild/batch9-guild-app/guild-app-final/batch9-guild-app/guild-app/resources/views/auth/login.blade.php ENDPATH**/ ?>