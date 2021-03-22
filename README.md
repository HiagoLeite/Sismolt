# SISMOLT(Sistema de monitoração de deslizamento)

## Descrição do Projeto

<p aling="center">
A finalidade do projeto é com relação a segurança, por intermédio de um sistema de monitoração de deslizamento, o projeto foi idealizado para ser implementado em áreas íngremes afim de evitar deslizamentos. 

O Sismolt funciona a partir de um sensor que vai captar valores de 0 a 1024 que representa a umidade do solo partir desses dados será verificado o estado do solo e o grau de perigo oferecido, com estas informações e verificado a constância de repetição das informações a fim de evitar dados repitidos e ate problemas com o Banco de dados do projeto, para salvar os dados no banco é feito uma requisição na url da página. Mas antes é necessário que o usuário realize um cadastro e um login, o sistema conta também com o envio de email.
</p>

Indice conteudos
================
<!--ts-->
* [Descrição do Projeto](#descrição-do-projeto)
* [Indice conteudos](#indice-conteudos)
* [Status do projeto](#status-do-projeto)
* [Feaatures](#features)
* [Tecnologias](#tecnologias)
* [Pre Requisitos](#pre-requisitos)
* [Instalação](#instalação)
* [Como contribuir](#como-contribuir)
* [Autor](#autor)
* [Licença](#licença)
<!--te-->

## Status do Projeto
> Projeto Sismolt: em desenvolvimento :warning:

### Features

- [x] cadastro e login de usuário
- [x] SESSION e home
- [x] armazenamento dos dados do sensor no banco
- [x] notificações no email
- [ ] PWA da aplicação

### Tecnologias

<p> Linguagens</p>

- [Html]
- [Css]
- [Php]
- [C++]
- [MySql]
- [Js]

<p> Componentes</p>

- [Protoboard]
- [Esp-32]
- [Sensor-de-umidade-do-solo]
- [Resistor]
- [Jumper]
- [Led]

### Pre Requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:  
[Git]( https://git-scm.com/downloads),
[Xampp](https://www.apachefriends.org/pt_br/index.html) para ser o servidor e também para a criação do banco de dados.
É necessario tambem ter no minimo, 1 Protoboard , 1 Esp-32(pode ser outro microcontrolador, porem tem que ter a placa wifi nele), 3 leds de cores diferentes, 3 resistores, caso queira investir em 1 Sensor de umidade do solo sera necessário de 10 ha 15 jumpers se não quiser não tem problema, pois os valores podem ser simulados, sendo necessario apenas 7 jumpers.
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/) e [Arduino](https://www.arduino.cc/en/software) esta ide ja vem com algumas bibliotecas e com exemplos muito bom para estudo e desenvolvimento de projetos similares.

### Instalação

Ao iniciar a instalação do xampp e de importancia prestar atenção na seleção de ferramentas a se instalar sendo de suma importancia o Mysql(então marque a caixa que corresponde a mesma).
Apos a instalação das ferramentas, é necessário baixar 2 bibliotecas na ide Arduino, para isso acesse o menu: Sketch > Incluir Biblioteca, depois você ira conferir se a biblioteca [Wifi](https://www.arduino.cc/en/Reference/WiFi) ja esta instalada, caso não esteja basta instalar simples, para a segunda biblioteca [ESP-Mail-Client-master](https://github.com/mobizt/ESP-Mail-Client) segue o mesmo procedimento.

No git-bash:
```bash
# Antes de mais nada acesse esse diretório na sua maquina utiliza o cd .. para chegar no diretório /c
$cd ..
$cd xampp 
$cd htdocs
# Clone este repositório
$ git clone <https://github.com/HiagoLeite/Sismolt.git>
# acesse o vsCode
$ code
```

Agora com os codigos em mãos, copie e cole na ide do Arduino o codigo do arquivo esp32.ino (compile para o seu micro-controlador os codigos por meio de um cabo usb). Copie o codigo do arquivo bd.sql abra o seu servidor xampp e clique na opção  admin que esta na linha do MySql, após isso basta criar um banco e selecionar SQL na barra, e compilar o codigo.
Para rodar a página web acesse http://localhost/Sismolt/

## Como Contribuir 

1. Faça um fork do projeto
2. Crie sua branch: git checkout -b my-feature
3. Salve suas alterações e faça um commit: git commit -m "Feature: minha alteração"
4. Envie as alterações: git push origin my-feature

## Autor
---
 
 Projeto desenvolvido por Hiago Leite.
