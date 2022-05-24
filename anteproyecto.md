# ESP_DOMOTIC

## Indice

<div style="text-align: center;">

  - [Introducción](#introduccion)
  - [Problemas](#problemas)
  - [Objetivos](#objetivos)
  - [Requisitos](#requisitos)

</div>


<div id="introduccion">

## Introducción

La principal finalidad del proyecto es poder **domotizar una estancia** o incluso llegar a domotizar una casa, mediante el uso de una **aplicación web** alojada en un **VPS o en un servidor local** de forma que con un simple vistazo podemos ver y gestionar diferentes dispositivos, ya sean lámparas, persianas, etc.

Para la **gestión de los dispositivos** se conectarán directamente a un **Arduino** con una conexión a internet para poder acceder a la **base de datos** con los estados de los dispositivos. Posteriormente para la aplicación web esta hecha en su mayoría con **PHP** junto un framework de **JavaScript (Jquery)**. Dicha aplicación tendrá un **login de usuarios** para evitar que todo el que se conecte a la aplicación pueda gestionar los dispositivos, para ello dichos usuarios serán almacenados en una **base de datos relacional** y todos los campos de los formularios de login y registro tendrán que **estar protegidos para evitar SQLi**. Para la actualización de los estados en la base de datos de los diferentes dispositivos a través de la aplicación, se implementará el uso de **funciones Ajax** para hacer **las operaciones de forma asíncrona** y sin que la aplicación sea refrescada cada vez que se modifica el estado de un dispositivo. Para la parte de frontend se utilizara **CSS** y junto con **Boostrap** (un framework de CSS).

Para la administración de los dispositivos en Arduino utilizaremos el lenguaje de programación **C++**.


<div id="problemas">

## Problemas

Los principales problemas que surgiran en la realización del proyecto sera la implementación de **Ajax** para la actualizaciones de las bases de datos, mediante el uso de **JavaScript**. JavaScript es un lenguaje de programacion que no he utilizado mucho por lo que durante la implementación sera necesario ir documentandose. Otro de los posibles inconvenientes es la utilización de C++ para la programación del Arduino, ya que hace bastante tiempo que no lo utilizo, pero es una situación diferente que con JavaScript puesto que este ultimo lo he utilizado muy poco, pero C++ si que lo he utilizado bastante.

<div id="objetivos">

## Objetivos

- Login y registro de usuarios
- Actualización de la base de datos mediante uso de funcion Ajax
- Obtener los valores de la base datos desde Arduino

Siendo la finalidad final la domotización de distintos dispositivos(Leds, Persianas, etc).

<div id="requisitos">

## Requisitos

- Ordenador donde desarrollar
- Arduino
- Dispositivos (Leds, motor paso a paso, etc)
- Servidor VPS
