<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <a href="#" class="btn btn-block signup-login-form__btn-xl btn-large btn-facebook">
        <span class="icon-container">
          <i class="fa fa-facebook"></i>
        </span>
        <span>
          Login with Facebook
        </span>
      </a>
      <a href="#" class="btn btn-block signup-login-form__btn-xl btn-large btn-google">
        <span class="icon-container">
          <i class="fa fa-google"></i>
        </span>
        <span>
          Login with Google
        </span>
      </a>
      <div class="signup-or-separator">
        <span class="signup-or-separator--text">or</span>
        <hr>
      </div>
      <form accept-charset="UTF-8" action="/authenticate" class="login-form " data-action="Signin" method="post">
        <div class="control-group">
          <input class="decorative-input inspectletIgnore" id="signin_email" name="email" placeholder="Email Address" type="email" value="butrentron123@gmail.com">
        </div>
        <div class="control-group">
          <input autofocus="autofocus" class="decorative-input inspectletIgnore" id="signin_password" name="password" placeholder="Password" type="password">
        </div>
        <div class="clearfix">
          <label for="remember_me" class="remember-me">
            <input type="checkbox" name="remember_me" id="remember_me" value="true" class="remember_me">
            Remember me
          </label>
          <a href="" class="forgot-password pull-right">Forgot password?</a>
        </div>
        <div id="airlock-inline-container"></div>
        <button type="submit" class="btn btn-block signup-login-form__btn-xl btn-primary btn-large" id="user-login-btn">
        Log in
        </button>
      </form>
      <div class="modal-footer">
        <span class="pull-left md-switch">Don’t have an account?</span>
        <button type="button" class="btn btn-primary-o pull-right">Sign up</button>
      </div>
    </div>
  </div>
</div>