create database dashboard collate utf8_unicode_ci;

use dashboard;

create table tb_vendas(
	id int not null primary key auto_increment,
	data_venda datetime default current_timestamp,
	total float(10,2) not null
);

create table tb_clientes(
	id int not null primary key auto_increment,
	cliente_ativo boolean default true
);



create table tb_tipo_contatos(
	tipo_contato int not null primary key auto_increment,
	descricao varchar(100) not null
);

create table tb_contatos(
	id int not null primary key auto_increment,
	tipo_contato int not null,
	foreign key(tipo_contato) references tb_tipo_contatos(tipo_contato));

create table tb_despesas(
	id int not null primary key auto_increment,
	data_despesa datetime default current_timestamp,
	total float(10,2) not null
);

insert into tb_vendas(data_venda, total)values('2020-03-25', 50.20);
insert into tb_vendas(data_venda, total)values('2020-04-27', 100.20);
insert into tb_vendas(data_venda, total)values('2020-05-29', 245.36);
insert into tb_vendas(data_venda, total)values('2020-07-16', 375.36);
insert into tb_vendas(data_venda, total)values('2020-08-16', 255.36);
insert into tb_vendas(data_venda, total)values('2020-08-18', 70.95);
insert into tb_vendas(data_venda, total)values('2020-09-01', 35.00);
insert into tb_vendas(data_venda, total)values('2020-09-11', 2047.12);
insert into tb_vendas(data_venda, total)values('2020-09-19', 122.85);
insert into tb_vendas(data_venda, total)values('2020-09-23', 957.14);
insert into tb_vendas(data_venda, total)values('2020-10-01', 333.55);
insert into tb_vendas(data_venda, total)values('2020-10-02', 100.33);
insert into tb_vendas(data_venda, total)values('2020-10-03', 1853.12);
insert into tb_vendas(data_venda, total)values('2020-10-04', 47.47);
insert into tb_vendas(data_venda, total)values('2020-12-20', 2057.00);

-- true/1 = ativo | false/0 = inativo
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);

insert into tb_tipo_contatos(tipo_contato, descricao)values(1, 'elogio');
insert into tb_tipo_contatos(tipo_contato, descricao)values(2, 'sugestao');
insert into tb_tipo_contatos(tipo_contato, descricao)values(3, 'reclamacao');

-- 1 = cr??tica | 2 = sugest??o | 3 = elogio
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);

insert into tb_despesas(data_despesa, total)values('2020-03-25', 14.90);
insert into tb_despesas(data_despesa, total)values('2020-04-27', 23.47);
insert into tb_despesas(data_despesa, total)values('2020-05-29', 12.68);
insert into tb_despesas(data_despesa, total)values('2020-07-18', 80.08);
insert into tb_despesas(data_despesa, total)values('2020-08-20', 93.47);
insert into tb_despesas(data_despesa, total)values('2020-09-01', 350.27);
insert into tb_despesas(data_despesa, total)values('2020-09-04', 108.12);
insert into tb_despesas(data_despesa, total)values('2020-09-20', 15.66);
insert into tb_despesas(data_despesa, total)values('2020-10-03', 83.55);
insert into tb_despesas(data_despesa, total)values('2020-12-20', 110.00);