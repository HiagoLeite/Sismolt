# SISMOLT(Sistema de monitoração de deslizamento)

## Descrição do Projeto

<p aling="center">
A finalidade do projeto é com relação a segurança, por intermédio de um sistema de monitoração de deslizamento, o projeto foi idealizado para ser implementado em áreas íngremes afim de evitar deslizamentos. 

O Sismolt funciona a partir de um sensor que vai captar valores de 0 a 1024 que representa a umidade do solo partir desses dados será verificado o estado do solo e o grau de perigo oferecido, com estas informações e verificado a constância de repetição das informações a fim de evitar dados repitidos e ate problemas com o Banco de dados do projeto, para salvar os dados no banco é feito uma requisição na url da página. Mas antes é necessário que o usuário realize um cadastro e um login. 
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
- [ ] notificações no email
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
É necessario tambem ter no minimo, 1 Protoboard , 1 Esp-32(pode ser outro microcontrolador, porem tem que ter a placa wifi nele), 3 leds de cores diferentes, 3 resistores, caso queira investir em 1 Sensor de umidade do solo sera necessario de 10 ha 15 jumpers se não quiser não tem problema, pois os valores podem serem simulados, sendo necessario apenas 7 jumpers.
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/) e [Arduino](https://www.arduino.cc/en/software) esta ide ja vem com algumas bibliotecas e com exemplos muito bom para estudo e desenvolvimento de projetos similares.


## Como Contribuir 

1. Faça um fork do projeto
2. Crie sua branch: git checkout -b my-feature
3. Salve suas alterações e faça um commit: git commit -m "Feature: minha alteração"
4. Envie as alterações: git push origin my-feature

## Autor
---
 
 Projeto desenvolvido por Hiago Leite.

### Licença

MIT License

Copyright (c) <2021> <HiagoLeite>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.