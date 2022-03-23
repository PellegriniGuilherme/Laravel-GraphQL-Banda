## <p align="center">Projeto Banda</p>
##### _Back-end Laravel 9 + GraphQL_
![Laravel](https://img.shields.io/badge/-Laravel-383838?style=for-the-badge&logo=Laravel) ![GraphQL](https://img.shields.io/badge/-GraphQL-383838?style=for-the-badge&logo=GraphQL)

_Models_
A modelagem para esse projeto foi pensada de forma simples.

##### Abums
- title: Titulo do álbum (varchar: 255)
- description: Descrição do álbum (text)
- release: Data de lançamento do álbum (date)

##### Musics
- title: Titulo da música (varchar: 255)
- duration: Duração da música (time)
- composers: Campo de texto para inserir todos os compositoes envolvidos nessa musica (varchar: 255)
- producers: Campo de texto para inserir todos os produtores envolvidos nessa musica (varchar: 255)
- album_id : ID do album (relacionamento varias músicas para um álbum) (bigint(20))
    
##### Lyrics
- title: Titulo da Música (levando em consideração o fato língua a letra possuira um titulo em outra língua)
- language: Língua da letra (varchar: 5) exemplo: 'pt-br', 'en-us', etc...
- lyric: Letra da musica (text)
- music_id: ID da musica (relacionamento varias letras para uma música)


###### <p align="center">Desenvolvido por Guilherme Pellegrini Coelho</p>