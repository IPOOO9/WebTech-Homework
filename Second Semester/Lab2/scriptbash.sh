#!/bin/bash

echo "Текущий пользователь: $USER"

file="findmeplease^_^.txt"

find . -type f -name $file
echo "Искомый файл найден"

echo "Информация об искомом файле:"
file $file

