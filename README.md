# Hotmart PHP SDK

Biblioteca criada para viabilizar de forma simples a utilização das funcionalidades da API da Hotmart em projetos em PHP.

É altamente recomendado acessar a documentação oficial da [API da Hotmart](https://developers.hotmart.com/docs/pt-BR/) antes de utilizar essa biblioteca.

## Índice

- [Instalação](#instalação)
- [Testes](#testes)
- [Configuração](#configuração)
- [API](#api)
    - [Assinaturas](#assinaturas)
        - [Obter assinaturas](#obter-assinaturas)
        - [Sumário de assinaturas](#sumário-de-assinaturas)
        - [Compras de assinantes](#compras-de-assinantes)
        - [Cancelar assinatura](#cancelar-assinatura)
        - [Cancelar lista de assinaturas](#cancelar-lista-de-assinaturas)
        - [Reativar assinatura](#reativar-assinatura)
        - [Reativar lista de assinaturas](#reativar-lista-de-assinaturas)
        - [Alterar dia da cobrança da assinatura](#alterar-dia-da-cobrança-da-assinatura)
    - [Transações (vendas)](#transações-vendas)
        - [Histórico de vendas](#histórico-de-vendas)
        - [Sumário de vendas](#sumário-de-vendas)
        - [Participantes de vendas](#participantes-de-vendas)
        - [Comissões de vendas](#comissões-de-vendas)
        - [Detalhamento de preços de vendas](#detalhamento-de-preços-de-vendas)
        - [Reembolso de venda](#reembolso-de-venda)
    - [Área de membros](#área-de-membros)
        - [Obter módulos](#obter-módulos)
        - [Obter páginas de um módulo](#obter-páginas-de-um-módulo)
        - [Obter usuários](#obter-usuários)
        - [Obter progresso de um usuário](#obter-progresso-de-um-usuário)

## Instalação

Instale a biblioteca utilizando o comando

`composer require joao-pedro-alves/hotmart-php-sdk`

## Testes

`docker compose run php vendor/bin/phpunit`

## Configuração

### Obtendo credenciais

Para iniciar a configuração da biblioteca é necessário antes obter as credenciais de acesso à API da Hotmart.

1. Acesse a área de Credenciais da Hotmart através da URL: https://app.hotmart.com/tools/credentials

2. Clique em **"Criar credenciais"**

3. Selecione **"API Hotmart"** e clique em **"Criar credenciais"**

4. Informe um nome para identificar essas credenciais, por exemplo **"Aplicação Web"** e prossiga clicando em **"Criar credencial"**

5. Salve as **Chaves de acesso (Cliente ID, Client Secret e Basic)**, essas informações serão utilizadas para a configuração.

### Configurando SDK

Instancie a classe de cliente da SDK passando como parâmetros os dados das credenciais obtidos no passo anterior

```php
<?php
use Hotmart;

$hotmart = new Hotmart\Client(
    'a60ea46d-fd4a-48b6-a10b-823a9c3c1a35',
    '5e7ab2d7-6cd3-2da5-bc6b-45e10ab15021',
    'LTawYmU4NmQtZmQ0YS00OGI2LWGxMGItODkzYTljM2MxZTM1OjJlN7FhMmQ1LTZkZDctNJRmNS1iZTliLTk1ZTIwYmIxNTB1MX'
);
```

---

## API

Funcionalidades suportadas pela API da Hotmart.

Todos os métodos aceitam os parâmetros informados na documentação do end-point correspondente, assim como também seu valor de retorno.

### Assinaturas

Operações relacionadas a assinaturas.

#### Obter assinaturas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->get($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/get-subscribers/)

#### Sumário de assinaturas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->summary($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/get-subscription-summary/)

#### Compras de assinantes

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->purchases($subscriberCode, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/get-subscription-purchases/)

#### Cancelar assinatura

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->cancel($subscriberCode, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/cancel-subscription/)

#### Cancelar lista de assinaturas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->cancelList($subscriberCodeArray, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/cancel-subscriptions/)

#### Reativar assinatura

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->reactivate($subscriberCode, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/reactivate-subscription/)

#### Reativar lista de assinaturas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->reactivateList($subscriberCodeArray, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/reactivate-subscriptions/)

#### Alterar dia da cobrança da assinatura

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->subscriptions()->changeChargeDay($subscriberCode, $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/subscription/change-due-day/)

### Transações (vendas)

Operações relacionadas as vendas.

#### Histórico de vendas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->history($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-history/)

#### Sumário de vendas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->summary($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-summary/)

#### Participantes de vendas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->participants($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-users/)

#### Comissões de vendas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->commissions($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-commissions/)

#### Detalhamento de preços de vendas

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->priceDetails($paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-price-details/)

#### Reembolso de venda

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->transactions()->refund($transactionCode);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/sales/sales-refund/)

### Área de membros

Operações relacionadas as informações da área de membros.

#### Obter módulos

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->club()->modules('NOME_DO_SUBDOMINIO', $paramsArray);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/club/get-modules-club/)

#### Obter páginas de um módulo

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->club()->modulePages($subDomain, $moduleId);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/club/get-pages-club/)

#### Obter usuários

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->club()->users($subDomain);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/club/get-users-club/)

#### Obter progresso de um usuário

```php
<?php
$hotmart = new Hotmart\Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
$hotmart->club()->userLessons($subDomain, $userId);
```

[Ver documentação](https://developers.hotmart.com/docs/pt-BR/v1/club/get-lessons-club/)