<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/toggleButton.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://kit.fontawesome.com/19a4289b4a.js" crossorigin="anonymous"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

</head>
<style>
    .navbar{
        background-color: #343a40 !important;
    }
</style>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">QBS Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/">Главная</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#">О нас</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#">Написать пост</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#">Контакты</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Заргестрироваться') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="#" class="dropdown-item">Профиль</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<?php
    $user = Auth::user();
?>
@if (!auth()->user()->hasVerifiedEmail())
    <div class="alert alert-warning">
        Ваш email не подтверждён. <a href="{{ route('verification.notice') }}">Подтвердите его</a>.
    </div>
@endif
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="row bg-white rounded p-4 shadow" style="width: 60%;">
        <div>
            <label class="switch">
                <input type="checkbox" id="subscription-toggle"
                    {{ auth()->user()->isSubscribed() ? 'checked' : '' }} onclick="toggleNotification()">
                <span class="slider round"></span>
            </label>
            <span>Уведомления</span>
        </div>
        <div class="col-md-6 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-3" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">{{$user->name}}</span>
                <span class="text-black-50">{{$user->email}}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-center w-100">Профиль</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Имя</label><input type="text" class="form-control" placeholder="Имя" value="{{$user->name}}"></div>
                    <div class="col-md-6"><label class="labels">Почта</label><input type="email" class="form-control" placeholder="Электронная почта" value="{{$user->email}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Пароль</label><input type="text" class="form-control" placeholder="Введите новый пароль" value=""></div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn btn-primary profile-button" type="button" onclick="edit()">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script>
    function edit() {
        if (!confirm("Вы уверены, что хотите сохранить изменения?")) return;

        let name = document.querySelector("input[placeholder='Имя']").value;
        let email = document.querySelector("input[placeholder='Электронная почта']").value;
        let password = document.querySelector("input[placeholder='Введите новый пароль']").value;
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("/users", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                name: name,
                email: email,
                password: password,
                password_confirmation: password // Для подтверждения пароля
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    alert(data.message);
                }
                else {
                    alert("Ошибка: " + (data.message || "Не удалось сохранить изменения."));
                }
            })
            .catch(error => {
                console.error("Ошибка при отправке запроса:", error);
                alert("Ошибка при обновлении профиля.");
            });
    }

    function toggleNotification(){
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/toggle-subscription', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            }).catch(error => {
            console.error("Ошибка при отправке запроса:", error);
            alert("Ошибка при подписке на уведомелния");
        });
    }
</script>

</body>
</html>
