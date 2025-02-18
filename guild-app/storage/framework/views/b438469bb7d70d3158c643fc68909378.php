<?php $__env->startSection('content'); ?>
<style>
    body {
        background-image: url("<?php echo e(asset('images/Ancient-Roman-Colosseum2.jpg')); ?>");
        background-position: top;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.6);
    }
    input {
        background-color: rgba(255, 255, 255, 0.6) !important;
    }
</style>

<div class="container">
    <div class="card w-50 m-auto" style="margin-top: 170px !important;">
        <div class="card-header text-center"><?php echo e(__('Register')); ?></div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- ユーザータイプ（フリーランス / 会社） -->
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Role')); ?></label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" value="2" id="company"
                                   <?php echo e(old('role_id') == '2' ? 'checked' : ''); ?> onclick="toggleFields()">
                            <label class="form-check-label" for="company">
                                <?php echo e(__('Company')); ?>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" value="3" id="freelance"
                                   <?php echo e(old('role_id') == '3' ? 'checked' : ''); ?> onclick="toggleFields()">
                            <label class="form-check-label" for="freelance">
                                <?php echo e(__('Freelance')); ?>

                            </label>
                        </div>
                    </div>
                </div>

                <!-- 会社向けのフィールド -->
                <div id="companyFields" style="display: none;">
                    <div class="row mb-3">
                        <label for="company_name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Company Name')); ?></label>
                        <div class="col-md-6">
                            <input id="company_name" type="text" class="form-control" name="company_name" value="<?php echo e(old('company_name')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Email Address')); ?></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="company_email" value="<?php echo e(old('email')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Password')); ?></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="company_password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="company_password_confirmation">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn w-100 bg-secondary">
                                <?php echo e(__('Register')); ?>

                            </button>
                        </div>
                    </div>
                </div>

                <!-- フリーランス向けのフィールド -->
                <div id="freelanceFields" style="display: none;">
                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Username')); ?></label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Name')); ?></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Email Address')); ?></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Password')); ?></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn w-100 bg-secondary">
                                <?php echo e(__('Register')); ?>

                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        let companyFields = document.getElementById('companyFields');
        let freelanceFields = document.getElementById('freelanceFields');
        let companyRadio = document.getElementById('company');
        let freelanceRadio = document.getElementById('freelance');

        if (companyRadio.checked) {
            companyFields.style.display = 'block';
            freelanceFields.style.display = 'none';
        } else if (freelanceRadio.checked) {
            companyFields.style.display = 'none';
            freelanceFields.style.display = 'block';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleFields();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ujibayashiryunosuke/Desktop/collabrate work/guild/batch9-guild-app/guild-app-final/batch9-guild-app/guild-app/resources/views/auth/register.blade.php ENDPATH**/ ?>