create table users (
    id serial not null constraint users_pkey primary key,
    name varchar(128) not null,
    surname varchar(128) not null,
    last_name varchar(128) not null,
    login varchar(128) not null,
    password_hash varchar(255) not null,
    role varchar(16) not null
);

alter table users owner to postgres;

create table tickets (
    id serial not null constraint tickets_pkey primary key,
    from_city varchar(64) not null,
    to_city varchar(64) not null,
    departure_date date not null,
    departure_time time not null,
    places integer not null,
    free_places integer not null,
    price integer not null
);

alter table tickets owner to postgres;

create table orders (
    id serial not null constraint orders_pkey primary key,
    ticket_id integer not null constraint orders_ticket_id_fkey references tickets on delete cascade,
    user_id integer not null constraint orders_user_id_fkey references users on delete cascade,
    is_ordered_for_this_user boolean not null,
    place integer not null
);

alter table orders owner to postgres;

/*пароль, который нужно вводить при авторизации - 123*/
INSERT INTO public.users (name, surname, last_name, login, password_hash, role) VALUES ('admin', 'admin', 'admin', 'admin', '$2y$10$zrNepTrPnXqcdd8Y9I6iX.u9PvFqsYdABCHqiRpy4BLb6mr7SfeU6', 'admin');