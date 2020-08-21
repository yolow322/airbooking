create table tickets
(
    id             int auto_increment
        primary key,
    from_city      varchar(64) not null,
    to_city        varchar(64) not null,
    departure_date date        not null,
    departure_time time        not null,
    places         int         not null,
    free_places    int         not null,
    price          int         not null
);

create table users
(
    id            int auto_increment
        primary key,
    name          varchar(128) not null,
    surname       varchar(128) not null,
    last_name     varchar(128) not null,
    login         varchar(128) not null,
    password_hash varchar(255) not null,
    role          varchar(16)  not null
);

create table orders
(
    id                       int auto_increment
        primary key,
    ticket_id                int        not null,
    user_id                  int        not null,
    is_ordered_for_this_user tinyint(1) not null,
    place                    int        not null,
    constraint orders_ibfk_1
        foreign key (ticket_id) references tickets (id)
            on delete cascade,
    constraint orders_ibfk_2
        foreign key (user_id) references users (id)
            on delete cascade
);

create index ticket_id
    on orders (ticket_id);

create index user_id
    on orders (user_id);

/*пароль, который нужно вводить при авторизации - 123*/
INSERT INTO public.users (name, surname, last_name, login, password_hash, role) VALUES ('admin', 'admin', 'admin', 'admin', '$2y$10$zrNepTrPnXqcdd8Y9I6iX.u9PvFqsYdABCHqiRpy4BLb6mr7SfeU6', 'admin');
