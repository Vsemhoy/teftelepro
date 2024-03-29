<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-grid.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-reboot.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-utilities.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/font/bootstrap-icons.css') }}"  type="text/css"/>

    <title>Registration</title>

<style>
  @use postcss-preset-env {
  stage: 0;
}

/* config.css */

:root {
  --baseColor: #606468;
}

/* helpers/align.css */

.align {
  display: grid;
  place-items: center;
}

.grid {
  inline-size: 96%;
  margin-inline: auto;
  max-inline-size: 40rem;
  backdrop-filter: blur(10px);
    border: 1px solid;
    box-shadow: inset 1px 0px 110px rgb(0 149 255 / 25%);
}

/* helpers/hidden.css */

.hidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

/* helpers/icon.css */

:root {
  --iconFill: var(--baseColor);
}

.icons {
  display: none;
}

.icon {
  block-size: 1em;
  display: inline-block;
  fill: var(--iconFill);
  inline-size: 1em;
  vertical-align: middle;
}

/* layout/base.css */

:root {
  --htmlFontSize: 100%;

  --bodyBackgroundColor: #2c3338;
  --bodyColor: var(--baseColor);
  --bodyFontFamily: "Open Sans";
  --bodyFontFamilyFallback: sans-serif;
  --bodyFontSize: 0.875rem;
  --bodyFontWeight: 400;
  --bodyLineHeight: 1.5;
}

* {
  box-sizing: inherit;
}

html {
  box-sizing: border-box;
  font-size: var(--htmlFontSize);
}

body {
  background-color: var(--bodyBackgroundColor);
  color: var(--bodyColor);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-position: top;
  background-image:url(http://bit.ly/2gPLxZ4);
  margin: 0;
  min-block-size: 100vh;
}

/* modules/anchor.css */

:root {
  --anchorColor: #eee;
}

a {
  color: var(--anchorColor);
  outline: 0;
  text-decoration: none;
}

a:focus,
a:hover {
  text-decoration: underline;
}

/* modules/form.css */

:root {
  --formGap: 0.875rem;
}

input {
  background-image: none;
  border: 0;
  color: inherit;
  font: inherit;
  margin: 0;
  outline: 0;
  padding: 0;
  transition: background-color 0.3s;
}

input[type="submit"] {
  cursor: pointer;
}

.form {
  display: grid;
  gap: var(--formGap);
}

.form input[type="password"],
.form input[type="email"],
.form input[type="text"],
.form input[type="submit"] {
  inline-size: 100%;
}

.form__field {
  display: flex;
}

.form__input {
  flex: 1;
}

/* modules/login.css */

:root {
  --loginBorderRadus: 0.25rem;
  --loginColor: #eee;

  --loginInputBackgroundColor: #3b4148;
  --loginInputHoverBackgroundColor: #434a52;

  --loginLabelBackgroundColor: #363b41;

  --loginSubmitBackgroundColor: #ea4c88;
  --loginSubmitColor: #eee;
  --loginSubmitHoverBackgroundColor: #d44179;
}

.login {
  color: var(--loginColor);
}

.login label,
.login input[type="text"],
.login input[type="email"],
.login input[type="password"],
.login input[type="submit"] {
  border-radius: var(--loginBorderRadus);
  padding: 1rem;
}

.login label {
  background-color: var(--loginLabelBackgroundColor);
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  padding-inline: 1.25rem;
}

.login input[type="password"],
.login input[type="email"],
.login input[type="text"] {
  background-color: var(--loginInputBackgroundColor);
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}
.login input[type="password"]:focus,
.login input[type="password"]:hover,
.login input[type="email"]:focus,
.login input[type="email"]:hover,
.login input[type="text"]:focus,
.login input[type="text"]:hover {
  background-color: var(--loginInputHoverBackgroundColor);
}

.login input[type="submit"] {
  background-color: var(--bs-btn-bg:);
  color: var(--loginSubmitColor);
  font-weight: 700;
  text-transform: uppercase;
}

.login input[type="submit"]:focus,
.login input[type="submit"]:hover {
  background-color: var(--bs-btn-hover-bg:);
}

/* modules/text.css */

p {
  margin-block: 1.5rem;
}

.text--center {
  text-align: center;
}
</style>
  </head>
<body class="align">

  <div class="grid p-4">
    <h4 class="text-white display-6">Hello, Friend!</h4>
    @if (Session::get('success'))
      <div class="alert alert-success">
        {{ Session::get('success')}}
      </div>
    @endif
    @if (Session::get('fail'))
      <div class="alert alert-warning">
        {{ Session::get('fail')}}
      </div>
    @endif
    @if (!Session::get('success') || !Session::get('fail'))
    <p class="text-white">Enter your personal details and start journey with us</p>
    @endif
    <form action="{{ route('auth.save')}}" method="POST" class="form login">
    @csrf
      <div class="form__field">
      <label for="login__username"><svg class="icon">
      <use xlink:href="#icon-user"></use>
      </svg><span class="hidden">Username</span></label>
      <input autocomplete="username" id="login__username" type="text" 
      name="name" class="form__input" placeholder="Username" required
      value="{{ old('name') }}">
      </div>
      <span class="text-danger">@error('username'){{ $message }} @enderror</span>

    <div class="form__field">
      <label for="login__email"><svg class="icon">
          <use xlink:href="#icon-user"></use>
        </svg><span class="hidden">Username</span></label>
      <input autocomplete="email" id="login__email" type="email" 
      name="email" class="form__input" placeholder="Email" required 
      value="{{ old('email') }}">
      </div>
      <span class="text-danger">@error('email'){{ $message }} @enderror</span>
        
      <div class="form__field">
        <label for="login__password"><svg class="icon">
            <use xlink:href="#icon-lock"></use>
          </svg><span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
        </div>
        <span class="text-danger">@error('password'){{ $message }} @enderror</span>

      <div class="form__field">
        <label for="login__password_repeat"><svg class="icon">
            <use xlink:href="#icon-lock"></use>
          </svg><span class="hidden">Repeat Password</span></label>
        <input id="login__password_repeat" type="password" name="checkpassword" class="form__input" placeholder="Password Repeat" required>
        </div>
        <span id="passnotmatch" class="text-danger">@error('checkpassword'){{ $message }} @enderror</span>
      
      <div class="form__field">
        <input id="btn__submit" type="submit" class="btn btn-primary" value="Sign In">
      </div>

    </form>

    <p class="text--center">You are member? <a href="{{ route('login')}}">Already have an account?</a> <svg class="icon">
        <use xlink:href="#icon-arrow-right"></use>
      </svg></p>

      </div>
      <a href="{{ route('home')}}" class="btn login-btn"><span>Go home</span>  <span><i class="bi-house" role="img" aria-label="Home"></i>

  <svg xmlns="http://www.w3.org/2000/svg" class="icons">
    <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
      <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
    </symbol>
    <symbol id="icon-lock" viewBox="0 0 1792 1792">
      <path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
    </symbol>
    <symbol id="icon-user" viewBox="0 0 1792 1792">
      <path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
    </symbol>
  </svg>

  <script>
    let password = document.querySelector("#login__password");
    let passwordcheck = document.querySelector("#login__password_repeat");
    let formsender = document.querySelector("#btn__submit");
    let passnotmatch = document.querySelector("#passnotmatch");
    formsender.addEventListener("click", function(e){
      if (password.value != passwordcheck.value){
        e.preventDefault();
        passnotmatch.innerHTML = "Passwords not match!";
        return false;
      } else {
        passnotmatch.innerHTML = "";
      }
    });

  </script>

</body>