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
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://kit.fontawesome.com/19a4289b4a.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
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
                            <a class="dropdown-item" href="{{ route('profile') }}">Профиль</a>
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
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>QBS Blog</h1>
                    <span class="subheading">напиши свой пост</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="bg-light">
        <div class="container py-5">
            <div class="search-wrapper">
                <div class="search-box">
                    <input id="search" type="text" class="search-input form-control" placeholder="Найти пост">
                    <i class="fas fa-search search-icon"></i>

                    <div class="suggestions">
                        <div class="recent-searches">Recent Searches</div>
{{--                        <div class="suggestion-item">--}}
{{--                            <i class="fas fa-history"></i>--}}
{{--                            Wireless Headphones--}}
{{--                        </div>--}}
{{--                        <div class="suggestion-item">--}}
{{--                            <i class="fas fa-history"></i>--}}
{{--                            Smart Watches--}}
{{--                        </div>--}}
{{--                        <div class="suggestion-item">--}}
{{--                            <i class="fas fa-search"></i>--}}
{{--                            Popular: Latest Smartphones--}}
{{--                        </div>--}}
{{--                        <div class="suggestion-item">--}}
{{--                            <i class="fas fa-fire"></i>--}}
{{--                            Trending: Fitness Trackers--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="container my-3">
                <div id="tags-container" class="d-flex flex-wrap gap-2 align-items-center justify-content-center"></div>
            </div>
        </div>
    </div>
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <div id="loader" class="text-center my-4 d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Загрузка...</span>
                </div>
                <p class="mt-2">Загрузка постов...</p>
            </div>
            <div id="posts-container">

            </div>
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4">
                <div id="pagination-container" class="pagination-container"></div>

            </div>

        </div>
    </div>
</div>

{{--MODAL FOR COMMENT EDITING--}}
<div class="modal fade" id="commentEditModal" tabindex="-1" aria-labelledby="commentEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentEditModalLabel">Редактирование комментария</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCommentForm" >
                    <textarea id="editCommentTxt" name="content" rows="3" required class="form-control" placeholder="Редактировать комментарий"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Редактировать</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer-->
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
            </div>
        </div>
    </div>

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadPosts(); // Загружаем посты при загрузке страницы
        loadTags();


        // Поиск постов по названию
        document.getElementById("search").addEventListener("input", function () {
            loadPosts(this.value);

        });
    });

    function loadComments(postId) {
        fetch(`/posts/${postId}/comments`)
            .then(response => response.json())
            .then(comments => {
                let commentsContainer = document.getElementById(`comments-${postId}`);
                commentsContainer.innerHTML = ""; // Очищаем контейнер

                // Загружаем комментарии
                if (comments.length === 0) {
                    commentsContainer.innerHTML += "<p>Нет комментариев.</p>";
                } else {
                    comments.forEach(comment => {
                        let commentHtml = `
                    <div class="container" id="comment-${comment.id}">
                        <div class="row d-flex justify-content-center">
                            <div class="">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <div class="avatarContainer">
                                                <i class="fa-solid fa-user" class="avatar"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 mx-2">
                                                <div>
                                                    <h6 class="fw-bold text-primary">${comment.user_name}</h6>
                                                    <p class="text-muted small commentTimeAgo" id="comment-time-${comment.id}">
                                                        ${comment.edited ? 'Отредактировано ' + comment.updated_at : comment.created_at}
                                                    </p>
                                                </div>
                                                ${comment.can_edit ? `
                                                <div>
                                                    <button class="btn btn-light btn-sm" onclick="editCommentModal(${comment.id})">
                                                        <i class="fa-solid fa-pen"></i> Редактировать
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteComment(${comment.id})">
                                                        <i class="fa-solid fa-trash"></i> Удалить
                                                    </button>
                                                </div>` : ""}
                                            </div>
                                        </div>
                                        <p id="comment-content-${comment.id}" class="px-3 py-2">${comment.content}</p>
                                        <div class="small d-flex justify-content-start">
                                            ${comment.is_authenticated ? `
                                                <button onclick="toggleCommentLike(${comment.id})"
                                                        id="comment-like-button-${comment.id}"
                                                        class="likeBtn ${comment.is_liked ? 'liked' : ''}">
                                                    <i class="${comment.is_liked ? 'fa-solid' : 'fa-regular'} fa-thumbs-up"></i>
                                                </button>
                                                <span id="comment-likes-count-${comment.id}">${comment.likes_count}</span>
                                            ` : ""}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                        commentsContainer.innerHTML += commentHtml;
                    });
                }

                // Добавляем форму для комментариев (всегда, независимо от наличия комментариев)
                let commentForm = `
            <hr>
            <form id="comment-form-${postId}" onsubmit="submitComment(event, ${postId})">
                <textarea id="comment-content-${postId}" name="content" rows="3" required class="form-control" placeholder="Добавьте комментарий"></textarea>
                <button type="submit" class="btn btn-primary mt-2">Отправить</button>
            </form>
            `;
                commentsContainer.innerHTML += commentForm;
            });
    }


    function submitComment(event, postId) {
        event.preventDefault();

        let commentInput = document.getElementById(`comment-content-${postId}`);
        let commentText = commentInput.value.trim();

        if (commentText === "") {
            alert("Комментарий не может быть пустым!");
            return;
        }

        fetch(`/posts/${postId}/comments`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content: commentText })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    commentInput.value = ""; // Очищаем поле ввода
                    loadComments(postId); // Обновляем список комментариев
                } else {
                    alert("Ошибка при добавлении комментария.");
                }
            })
            .catch(error => console.error("Ошибка:", error));
    }

    function loadTags() {
        fetch("/tags")
            .then(response => response.json())
            .then(tags => {
                let tagsContainer = document.getElementById("tags-container");
                tagsContainer.innerHTML = ""; // Clear previous tags

                tags.forEach(tag => {
                    let tagButton = document.createElement("button");
                    tagButton.classList.add("btn", "tag-btn");
                    tagButton.textContent = tag.name;
                    tagButton.setAttribute("data-tag", tag.name);

                    tagButton.addEventListener("click", function () {
                        tagButton.classList.toggle("active");
                        updateFilteredPosts();
                    });

                    tagsContainer.appendChild(tagButton);
                });
            });
    }

    function updateFilteredPosts() {
        let selectedTags = Array.from(document.querySelectorAll('.tag-btn.active'))
            .map(button => button.getAttribute("data-tag"));
        let searchText = document.getElementById("search").value.trim();
        loadPosts(searchText, selectedTags);
    }


    function loadPosts(searchQuery = "", tags = [], page = 1) {
        let tagsParam = tags.length > 0 ? `&tags=${encodeURIComponent(tags.join(","))}` : "";
        let searchParam = searchQuery.trim().length > 0 ? `search=${searchQuery}&` : "";

        let postsContainer = document.getElementById("posts-container");
        let loader = document.getElementById("loader");
        postsContainer.innerHTML = "";
        loader.classList.remove("d-none");

        fetch(`/posts?${searchParam}${tagsParam}&page=${page}`)
            .then(response => response.json())
            .then(data => {
                let posts = data.data; // Берем массив постов из `data`
                let postsContainer = document.getElementById("posts-container");
                postsContainer.innerHTML = ""; // Очищаем контейнер

                if (posts.length === 0) {
                    postsContainer.innerHTML = "<p>Постов нет.</p>";
                    return;
                }

                posts.forEach(post => {
                    let tagsHtml = ""; // Генерация тегов
                    if (post.tags && post.tags.length > 0) {
                        tagsHtml = '<div class="mt-2"><strong>Теги:</strong> ';
                        post.tags.forEach(tag => {
                            tagsHtml += `<span class="badge bg-secondary mx-1">${tag}</span>`;
                        });
                        tagsHtml += '</div>';
                    }

                    let postHtml = `
                    <div class="post-preview">
                        <div>
                            <h2 class="post-title">${post.title}</h2>
                            ${tagsHtml}
                            <img src="/storage/${post.image}" class="img-fluid"   alt="">
                            <p class="post-subtitle">${post.content}</p>
                        </div>
                        <p class="fst-italic">Posted ${post.created_at}</p>

                        ${post.is_authenticated ? `
                            <button onclick="toggleLike(${post.id})"
                                    id="like-button-${post.id}"
                                    class="${post.is_liked ? 'liked' : ''} likeBtn">
                                <i class="${post.is_liked ? 'fa-solid' : 'fa-regular'} fa-thumbs-up"></i>
                            </button>
                            <span id="likes-count-${post.id}">${post.likes_count}</span>
                        ` : ""}

                        <h5>Комментарии:</h5>
                        <div class="comments" id="comments-${post.id}">
                            <p>Загрузка комментариев...</p>
                        </div>
                    </div>
                    <hr class="my-4"/>`;

                    postsContainer.innerHTML += postHtml;

                    // Загружаем комментарии
                    loadComments(post.id);
                });

                // Отрисовка пагинации
                renderPagination(data.current_page, data.last_page);
            }).finally(()=> {
                loader.classList.add("d-none");


        });
    }


    function renderPagination(currentPage, lastPage) {
        let paginationContainer = document.getElementById("pagination-container");
        paginationContainer.innerHTML = ""; // Очищаем контейнер

        if (lastPage <= 1) return; // Если всего одна страница, скрываем пагинацию

        let paginationHtml = `<nav><ul class="pagination justify-content-center">`;

        // Кнопка "Предыдущая"
        paginationHtml += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="loadPosts('', [], ${currentPage - 1})">Предыдущая</a>
        </li>`;

        // Номера страниц
        for (let i = 1; i <= lastPage; i++) {
            paginationHtml += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadPosts('', [], ${i})">${i}</a>
            </li>`;
        }

        // Кнопка "Следующая"
        paginationHtml += `
        <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="loadPosts('', [], ${currentPage + 1})">Следующая</a>
        </li>`;

        paginationHtml += `</ul></nav>`;

        paginationContainer.innerHTML = paginationHtml;

        document.getElementById("posts-container").scrollIntoView({ behavior: "smooth" });

    }


    function toggleLike(postId) {
        let button = document.getElementById(`like-button-${postId}`);
        let likesCount = document.getElementById(`likes-count-${postId}`);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            console.error("CSRF token not found.");
            return;
        }

        let isLiked = button.classList.contains("liked"); // Проверяем, лайкнут ли уже пост

        // Мгновенно меняем интерфейс без ожидания сервера
        if (isLiked) {
            button.innerHTML = `<i class="fa-regular fa-thumbs-up"></i>`; // Убираем лайк
            button.classList.remove("liked");
            likesCount.textContent = Math.max(0, parseInt(likesCount.textContent) - 1);
        } else {
            button.innerHTML = `<i class="fa-solid fa-thumbs-up"></i>`; // Ставим лайк
            button.classList.add("liked");
            likesCount.textContent = parseInt(likesCount.textContent) + 1;
        }

        // Отправляем запрос асинхронно, но UI уже обновился
        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).catch(error => console.error('Error:', error)); // Если ошибка - просто логируем
    }

    function toggleCommentLike(commentId) {
        let button = document.getElementById(`comment-like-button-${commentId}`);
        let likesCount = document.getElementById(`comment-likes-count-${commentId}`);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            console.error("CSRF token not found.");
            return;
        }

        let isLiked = button.classList.contains("liked"); // Проверяем, лайкнут ли уже коммент

        // Мгновенно обновляем UI без ожидания сервера
        if (isLiked) {
            button.innerHTML = `<i class="fa-regular fa-thumbs-up"></i>`; // Убираем лайк
            button.classList.remove("liked");
            likesCount.textContent = Math.max(0, parseInt(likesCount.textContent) - 1);
        } else {
            button.innerHTML = `<i class="fa-solid fa-thumbs-up"></i>`; // Ставим лайк
            button.classList.add("liked");
            likesCount.textContent = parseInt(likesCount.textContent) + 1;
        }

        // Асинхронный запрос, UI уже обновился
        fetch(`/comments/${commentId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).catch(error => console.error('Error:', error)); // Ошибки просто логируем
    }

    function deleteComment(commentId) {
        if (!confirm("Вы уверены, что хотите удалить этот комментарий?")) return;

        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`comment-${commentId}`).remove(); // Удаляем комментарий из DOM
                } else {
                    alert("Ошибка: " + data.message);
                }
            })
            .catch(error => console.error('Ошибка при удалении комментария:', error));
    }

    function editCommentModal(commentId) {
        let modal = new bootstrap.Modal(document.getElementById('commentEditModal'));
        document.getElementById("editCommentForm").setAttribute("data-comment-id", commentId)
        let modalBody = document.getElementById("editCommentTxt");

        modal.show(null);


        let oldContent = document.getElementById(`comment-content-${commentId}`);
        modalBody.value = oldContent.textContent.trim()
    }

    document.getElementById("editCommentForm").addEventListener("submit", function (event) {
        event.preventDefault();

        let form = event.target;
        let commentId = form.getAttribute("data-comment-id");
        let content = document.getElementById("editCommentTxt").value.trim();
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        console.log("COMMENT ID:" + commentId)

        fetch(`/comments/${commentId}`, {
            method: "PUT",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ content: content })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`comment-content-${commentId}`).textContent = content;
                    let modalElement = document.getElementById('commentEditModal');
                    let modalInstance = bootstrap.Modal.getInstance(modalElement); // Get the existing instance
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    document.getElementById(`comment-time-${commentId}`).textContent = 'Отредактировано 1 sec ago'
                } else {
                    console.log("Ошибка: " + data.message);
                }
            })
            .catch(error => console.error("Ошибка при редактировании комментария:", error));
    });
</script>
