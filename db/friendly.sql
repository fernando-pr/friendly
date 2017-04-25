drop table if exists usuarios cascade;

create table usuarios (
    id         bigserial    constraint pk_usuarios primary key,
    nombre     varchar(15)  not null constraint uq_usuarios_nombre unique,
    password   varchar(60)  not null,
    email      varchar(255) not null,
    poblacion  varchar(255) not null,
    provincia  varchar(255) not null,
    token      varchar(32),
    activacion varchar(32),
    created_at timestamptz  default current_timestamp
);

create index idx_usuarios_activacion on usuarios (activacion);
create index idx_usuarios_created_at on usuarios (created_at);


--usuarios de prueba

insert into usuarios(nombre, password, email, poblacion, provincia)
values ('admin', crypt('admin', gen_salt('bf', 13)), 'admin@admin.com', 'Sanlúcar de Barrameda', 'Cádiz');

insert into usuarios(nombre, password, email, poblacion, provincia)
values ('demo', crypt('demo', gen_salt('bf', 13)), 'demo@demo.com', 'Sanlúcar de Barrameda', 'Cádiz');

insert into usuarios(nombre, password, email, poblacion, provincia)
values ('paco', crypt('paco', gen_salt('bf', 13)), 'demo@demo.com', 'Sanlúcar de Barrameda', 'Cádiz');

insert into usuarios(nombre, password, email, poblacion, provincia)
values ('pepe', crypt('pepe', gen_salt('bf', 13)), 'demo@demo.com', 'Sanlúcar de Barrameda', 'Cádiz');

insert into usuarios(nombre, password, email, poblacion, provincia)
values ('jose', crypt('jose', gen_salt('bf', 13)), 'demo@demo.com', 'Sanlúcar de Barrameda', 'Cádiz');


drop table if exists estados cascade;
create table estados (
    id  bigserial   constraint pk_estados primary key,
    estado          varchar(30) not null unique
);

insert into estados (estado) values ('Solicitado');
insert into estados (estado) values ('Aceptado');

drop table if exists amigos cascade;

    create table amigos (

        id              bigserial   constraint pk_amigos primary key,

        id_usuario      bigint      not null constraint fk_amigos_usuarios_env
                                    references usuarios (id)
                                    on delete no action on update cascade,

        id_amigo        bigint      not null constraint fk_amigos_usuarios_rec
                                    references usuarios (id)
                                    on delete no action on update cascade,
        estado          varchar(30) not null constraint fk_amigos_estados
                                    references estados(estado)
                                    on delete no action on update cascade,
                                    constraint amigos_uq unique (id_usuario,id_amigo,estado)
    );


drop table if exists conectados cascade;

create table conectados (

    id_usuario          bigint          not null constraint fk_conectados_usuarios
                                        references usuarios (id),

    instante            timestamptz     not null default current_timestamp,

    constraint          pk_conectados   primary key (id_usuario)
);

drop table if exists publicos cascade;

create table publicos (

    id              bigserial   constraint pk_publicos primary key,

    id_usuario      bigint      not null constraint fk_publicos_usuarios
                                references usuarios (id)
                                on delete no action on update cascade,
    mensaje         text           not null,
    fecha           timestamptz    default current_timestamp
);


drop table if exists privados cascade;

create table privados (

    id              bigserial   constraint pk_privados primary key,

    id_emisor       bigint         not null constraint fk_privados_usuarios_emisor
                                   references usuarios (id)
                                   on delete no action on update cascade,
    id_receptor       bigint       not null constraint fk_privados_usuarios_receptor
                                   references usuarios (id)
                                   on delete no action on update cascade,
    mensaje         text           not null,
    fecha           timestamptz    default current_timestamp
);
