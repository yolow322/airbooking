//отображение текущих рейсов
function ticketsOut() {
    $.ajax({
        method: "POST",
        url: "src/ShowAvailableTickets.php",
        success:function(data) {
            $('.tickets-out').append(data);
        }
    });
}

//добавление билетов в мини-корзину
function addOrderToMiniCart() {
    var isOrderedForThisUser = Boolean(true);
    var ticketId = $(this).attr('data-ticket-id');
    var userId = $('.person-id').attr('data-person-id');
    $.ajax({
        method: "POST",
        url: "src/AddToMiniCart.php",
        data: {
            is_ordered_for_this_user: isOrderedForThisUser, user_id: userId, ticket_id: ticketId
        },
        success:function(data) {
            $('.recycle').html(data);
            showOrdersInMiniCart();
        }
    });
}

//отображение кол-ва билетов в мини-корзине
function showOrdersInMiniCart() {
    $.ajax({
        url: "src/ShowOrdersInMiniCart.php",
        method: "POST",
        success:function(data) {
            $('.mini-cart').empty();
            $('.mini-cart').append(data);
        }
    });
}

//убирает билеты из мини-корзины и со страницы с регистрацией билета
function deleteOrdersFromMiniCart() {
    var orderId= $(this).attr('data-order-id');
    $.ajax({
        url: "src/DeleteOrderFromCart.php",
        method: "POST",
        data: {
            id: orderId
        },
        success:function(data) {
            showOrdersInMiniCart();
            showOrdersInCart();
        }
    });
}

//удаляет билеты c регистрации пассажира
function deleteOrderFromCart() {
    var orderId= $(this).attr('data-cart-id');
    $.ajax({
        url: "src/DeleteOrderFromCart.php",
        method: "POST",
        data: {
            id: orderId
        },
        success:function(data) {
            showOrdersInCart();
        }
    });
}

//модальное окно
function Modal() {
    var modal = document.getElementById('Modal');
    var btn = document.getElementById("myOrders");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    };
    span.onclick = function() {
        modal.style.display = "none";
    };
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

//показывает все заказы в модальном окне
function showUserOrderedTickets() {
    $.ajax({
        url: "src/ShowUserOrders.php",
        method: "POST",
        success:function(data) {
            $('.modal-body').empty();
            $('.modal-body').append(data);
        }
    });
}

//удаляет выбранный заказанный билет
function deleteUserOrderedTicket() {
    var orderId= $(this).attr('data-order-id');
    var ticketId= $(this).attr('data-ticket-id');
    $.ajax({
        url: "src/DeleteUserOrderedTicket.php",
        method: "POST",
        data: {
            order_id: orderId,
            ticket_id: ticketId
        },
        success:function(data) {
            showUserOrderedTickets()
        }
    });
}

//добавление нового рейса со страницы админа
function addNewTicketFromAdminPage() {
    var fromCity = $("input[name='from-city']").val();
    var toCity = $("input[name='to-city']").val();
    var date = $("input[name='date']").val();
    var price = $("input[name='price']").val();
    var time = $("input[name='time']").val();
    var places = $("input[name='places']").val();
    $.ajax({
        url: "src/AddNewTicketFromAdminPage.php",
        method: "POST",
        data: {
            from_city: fromCity, to_city: toCity, departure_date: date, departure_time: time, places: places, price: price
        },
        success:function(data) {
            $('.tickets-out').append(data);
        }
    });
}

function userAuthentication() {
    var login = $("input[name='login']").val();
    var password = $("input[name='password']").val();
    $.ajax({
        url: "src/UserAuthorization.php",
        method: "POST",
        data: {
            login: login, password: password
        },
        success:function(data) {
            if (data == 'admin') {
                location.href = "admin.html";
            }
            else {
                if (data == 'success') {
                    location.href = "home.html";
                }
                else {
                    alert(data);
                }
            }
        }
    });
}

function userRegistration() {
    var name = $("input[name='name']").val();
    var surname = $("input[name='surname']").val();
    var lastName = $("input[name='last-name']").val();
    var login = $("input[name='login']").val();
    var password = $("input[name='password']").val();
    $.ajax({
        url: 'src/UserRegistration.php',
        method: "POST",
        data: {
            name: name, surname: surname, last_name: lastName, login: login, password: password
        },
        success:function(data) {
            alert(data);
        }
    });
}

//выводит имя и фамилию авторизированного пользователя
function checkAuthenticatedUser() {
    $.ajax({
        method: "POST",
        url: "src/CheckAuthenticatedUser.php",
        success: function (data) {
            $('.login-name').append(data);
        }
    });
}

//показывает билеты в корзине
function showOrdersInCart() {
    $.ajax({
        url: "src/ShowOrdersInCart.php",
        method: "POST",
        success:function(data) {
            $('.mini-cart-u').empty();
            $('.mini-cart-u').append(data);
        }
    });
}

//проверка на занятое место, которое есть в базе данных
function checkOccupiedPlace() {
    var ticketId = $(this).attr('data-ticket-id');
    $(this).parent('.ticket-form').attr('data-place', this.value);
    var occupiedPlace = $(this).parent('.ticket-form').attr('data-place');
    var placeCount = $(this).children('.place-item').length;
    var item = $(this).children('option');
    $.ajax({
        url: "src/CheckOccupiedPlace.php",
        method: "POST",
        data: {
            ticket_id: ticketId, place: occupiedPlace
        },
        success: function(data) {
            data = JSON.parse(data);
            $.each(data, function (key, value) {
                var i = key;
                for (var j = 0; j < placeCount - 1; j++) {
                    $(item[value = data[i].place]).prop('disabled', true);
                }
            });
        }
    });
}

//отправляет заказ с выбраным местом в бд
function sendOrderFromCart() {
    var chosenPlace;
    var orderId;
    var ticketId;
    $('.ticket-form').each(function(i) {
        chosenPlace = $(this).attr('data-place');
        orderId = $(this).attr('data-order-id');
        ticketId = $(this).attr('data-ticket-id');
        $.ajax({
            url: "src/SendOrderFromCart.php",
            method: "POST",
            data: {
                order_id: orderId, place: chosenPlace, ticket_id: ticketId
            },
            success:function(data) {
                if (isNaN(data)) {
                    alert("У вас нет билетов для заказа");
                }
            }
        });
    });
    alert('Заказ успешно совершен!');
    location.reload();
}

//таблица с рейсами, которая используется для удаления выбранного рейса
function tableWithTickets() {
    $.ajax({
        url: "src/TableWithTicketsFromAdminPage.php",
        method: "POST",
        success:function(data) {
            $('.delete-tickets-div').append(data);
        }
    });
}

function deleteTicketFromAdminPage() {
    var orderId= $(this).attr('data-delete-id');
    $.ajax({
        url: "src/DeleteTicketsFromAdminPage.php",
        method: "POST",
        data: {
            id: orderId
        },
        success:function(data) {
            tableWithTickets();
        }
    });
    alert('Выбраный рейс удалён!');
    location.reload();
}

$(document).ready(function () {
    showOrdersInCart();
    $('body').on('click','.places-list', checkOccupiedPlace);
    $('body').on('click', '.send-order-button', sendOrderFromCart);
    $('body').on('click', '.add-to-cart', addOrderToMiniCart);
    $('body').on('click', '.delete-from-mini-cart', deleteOrdersFromMiniCart);
    $('body').on('click', '.delete-user-ordered-ticket', deleteUserOrderedTicket);
    $('body').on('click', '.delete-from-cart', deleteOrderFromCart);
    $('body').on('click', '.delete-ticket', deleteTicketFromAdminPage);
    $('.login-button').on('click', userAuthentication);
    //регистрация аккаунта
    $('.button-for-user-registration').on('click', userRegistration);
    //для перехаода к регестрации
    $('.button-for-registration').on('click', function () {
        location.href = "registration.html";
    });
    $('.back-button').on('click', function () {
        location.href = "starting.html";
    });
    $('.back-to-home').on('click', function () {
        location.href = "home.html";
    });
    $('.to-cart').on('click', function () {
        location.href = "cart.html";
    });
    $('.exit-button').click(function(){
        $(function(){
            $.ajax({
                url: "src/UserLogout.php",
                success:function(data) {
                    location.href = "starting.html";
                }
            });
        });
    });
    $('.add-new-ticket-button').on('click', addNewTicketFromAdminPage);
    checkAuthenticatedUser();
    ticketsOut();
    showOrdersInMiniCart();
    tableWithTickets();
    showUserOrderedTickets();
    Modal();
});
