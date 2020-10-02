# Colarizador de Texto de Console

---------------------

Um arquivo simples para criar textos de console com cores.

## Classes

### Color

Uma classe abstrata com aguarda as cores possiveis de utilizar no console.

#### Lista de cores:

| Colores       |
|---------------|
| DEFAULT       |
| BLACK         |
| RED           |
| DEFAULT       |
| GREEN         |
| YELLOW        |
| BLUE          |
| MAGENTA       |
| CYAN          |
| LIGHT_GRAY    |
| DARK_GRAY     |
| LIGHT_RED     |
| LIGHT_GREEN   |
| LIGHT_YELLOW  |
| LIGHT_BLUE    |
| LIGHT_MAGENTA |
| LIGHT_CYAN    |
| WHITE         |


### Console

É uma classe estática com as funções que exibem textos coloridos.

### Funções Estaticas

**printc** ( _text, color, return=**true**_ )

Essa função foi criada para criar textos de console com uma cor a ser definida.

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   _color_:_**string**_ -> Nesse parâmetro deve ser colocado o código da cor.

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

---------------------

**info\_success** ( _text\_current, text\_succes="SUCESSO", symbol="✔"_ )

Essa função foi criada para criar uma mensagem informação algum resultado. Está pré definida como padrão de mensagem de sucesso, mas não é exclusiva a isso.

 *   _text\_current:_**string**_ -> Nesse parâmetro em que é colocado o texto ou a messagem

 *   (Opcional) _text\_succes:_**string**_ ->  Nesse parâmetro em que é colocado a mensagem de sucesso ou mensagem no final do texto.

 *   (Opcional) _symbol:_**string**_ ->  Nesse parâmetro em que é colocado o simbolo dessa mensagem.

--------------------

**info\_fail** ( _text\_current, text\_succes="FALHOU", symbol="✕"_ )

Essa função foi criada para criar uma mensagem informação algum resultado. Está pré definida como padrão de mensagem de erro ou falhou, mas não é exclusiva a isso.

 *   _text\_current:_**string**_ -> Nesse parâmetro em que é colocado o texto ou a messagem

 *   (Opcional) _text\_succes:_**string**_ ->  Nesse parâmetro em que é colocado a mensagem de sucesso ou mensagem no final do texto.

 *   (Opcional) _symbol:_**string**_ ->  Nesse parâmetro em que é colocado o simbolo dessa mensagem.

--------------------

**print\_red** ( _text, return=true_)

Essa função foi criada para criar textos de console na cor *vermelha*. Função herdada de *printc*

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

---------------------

**print\_green** ( _text, return=true_)

Essa função foi criada para criar textos de console na cor *verde*. Função herdada de *printc*

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

---------------------

**print\_blue** ( _text, return=true_)

Essa função foi criada para criar textos de console na cor *azul*. Função herdada de *printc*

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

---------------------

**print\_yellow** ( _text, return=true_)

Essa função foi criada para criar textos de console na cor *amarela*. Função herdada de *printc*

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

---------------------

**print\_white** ( _text, return=true_)

Essa função foi criada para criar textos de console na cor *branca*. Função herdada de *printc*

 *   _text_:_**string**_ -> Nesse parâmetro em que é colocado o texto

 *   (Opcional)_return_:_**bool**_ -> Através desse parâmetro que a função descide se deve retorna o texto com a cor (_**true**_) ou deve *printar* o texto (_**false**_)

--------------------