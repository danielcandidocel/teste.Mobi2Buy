<p align="center"><a href="https://mobi2buy.com/" target="_blank"><img src="https://mobi2buy.com/images/logo.png" width="400"></a></p>

## Sobre o Teste

### Introdução
Esse documento descreve o escopo de um sistema encurtador de URLs a ser implementado
pelo candidato a trabalhar na Mobi2buy.

### Requisitos funcionais

- Dada uma URL, a API deverá retornar sua versão encurtada. O tamanho da URL
encurtada deve ser o menor possível
Exemplo: ​ http://www.uol.com.br/noticias/abc.html​ -> ​ http://m2b.io/Kz78m
- Quando uma URL encurtada for acessada no browser, deve ser realizado um
redirecionamento para a URL completa
- API permitirá que o cliente escolha (caso deseje e esteja disponível) o nome da URL
encurtada
Exemplo: ​ http://www.uol.com.br/noticias/abc.html​ -> ​ http://m2b.io/noticia-abc
- As URLs encurtadas possuem um tempo de expiração padrão (7 dias) e devem ser
desativadas após o mesmo. Nesse caso, ao acessar uma URL expirada o sistema deve
retornar HTTP 404 (not found)

### Requisitos não-funcionais

- O redirecionamento da URL encurtada para a completa deve ser o mais eficiente possível
- A URL encurtada deve ser randômica o suficiente, evitando ser “descoberta” facilmente

### Implementação

- A API deve possuir 2 endpoints:
1. Criação de URL encurtada   
   Parâmetros:
    - URL original
   - URL encurtada desejada (opcional, padrão é randômico)
   - Data de expiração (opcional, padrão é expirar em 7 dias)   
 
    Retorno (JSON):
    - URL encurtada
    
2. URL encurtada
   - Não recebe parâmetros, apenas redireciona para a URL original
   - A API deve ser implementada na linguagem que for mais confortável ao candidato
   - A API não precisa de autenticação ou autorização, pois será de um serviço público
   - As URLs devem ser duráveis e persistidas em uma base de dados, seja essa SQL, NoSQL  ou similar
   - As URLs expiradas devem ser removidas da base de dados.

### Frontend
Desenvolver uma aplicação Frontend que seja capaz de permitir autenticação através de usuário
e senha e exibir uma lista com todas as URLs encurtadas.
A aplicação deverá consumir a API para realizar a listagem das URLs paginada.
A listagem de URLs deverá possuir paginação, a forma de paginação é de livre escolha.

### Pontos de Atenção
- Organização e clareza do código
- Testes
- Performance, escalabilidade e caching
- Persistência

## Configuração

- Composer update
- npm install && npm run dev
- php artisan migrate
- php artisan db:seed UserSeeder
    - Usuário padrão:
        - email: test@gmail.com
        - senha: 123456
- Seguir o exemplo do .env.example

## Endpoints
- /api/url
    - Método: POST
    - Parâmetros: 
        - url_complete: URL original (url, required)
        - expiration_date: Data de expiração (date(y-m-d), nullable, padrão 7 dias)
        - shortened: URL encurtada (string, nullable, padrão random)
    - Retorno:
        - json (url(url encurtada))
- /api/u/{SHORTENED}
    - Método: GET
    - Retorno:
       - success: redireciona para a URL original
       -     error: retorna erro 404 em caso de shortened inexistente ou expirado
        


