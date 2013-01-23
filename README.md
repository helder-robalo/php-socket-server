php-socket-server
=================

An app that runs as a service. I made an API to interprete commands and return message back. It's really usefull to work with non-native PC's hardware, such as Arduino, Raspberry pi, pyMCU or your own harware with ethernet interface

To properly connect your device with an PHP server socket must remember: The default protocol PHP socket is BSD-SOCKET. It will influence the way you shutdown the connection.