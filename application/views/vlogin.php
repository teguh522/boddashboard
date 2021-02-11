<div class="auth-main2 particles_js">
    <div class="auth_div vivify fadeInTop">
        <div class="card">
            <div class="body">
                <div class="login-img">
                    <img class="img-fluid" src="<?php echo base_url() ?>assets/images/GRUP.png" width="500px" />
                </div>

                <form class="form-auth-small" action="<?php echo base_url() ?>auth/login" method="POST">
                    <div class="mb-3">
                        <?php if ($this->session->flashdata('msg')) : ?>
                            <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                        <?php endif; ?>
                        <p class="lead">Login to your account</p>
                    </div>
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" name="email" required class="form-control round" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" name="password" required class="form-control round" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                    <div class="mt-4">
                        <span>Don't have an account? <a href="<?php echo base_url() ?>auth/register">Register</a></span>
                    </div>
                </form>
                <div class="pattern">
                    <span class="red"></span>
                    <span class="indigo"></span>
                    <span class="blue"></span>
                    <span class="green"></span>
                    <span class="orange"></span>
                </div>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->