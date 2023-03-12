Класс HtmlArray предоставляет удобный способ преобразования HTML-кода в массив PHP, который содержит информацию о каждом теге и его содержимом. Это может быть полезным, например, при работе с HTML-шаблонами, анализе веб-страниц и многих других случаях.

Класс содержит метод getArray(), который принимает строку с HTML-кодом в качестве аргумента и возвращает массив, содержащий информацию о каждом теге и его содержимом. Каждый элемент массива представляет собой ассоциативный массив со следующими ключами:

tagName - имя тега
attributes - массив атрибутов тега
data - содержимое тега (если оно есть)
children - массив дочерних элементов (если они есть)
Для парсинга HTML-кода используется стандартный класс DOMDocument, который позволяет легко обрабатывать деревья DOM.

Класс HtmlArray имеет конструктор, который принимает строку с HTML-кодом в качестве аргумента и сохраняет ее в приватном свойстве $htmlData. Это свойство используется в методе getArray(), если не передан аргумент с HTML-кодом.
