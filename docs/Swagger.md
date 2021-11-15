# Swagger

---

> Swagger est un outil permettant de faire de la documentation d'API. Il permet de lister les URLs avec les paramètres et les tester

## Installation

Permet de générer le fichier `api/doc.json`

`make composer.require.dev nelmio/api-doc-bundle`

---

`composer require --dev nelmio/api-doc-bundle`

Utilisation du docker swagger ui décommenter : `swagger-ui` dans le fichier : `docker-compose.override.yml.dist`.

Le swagger ui est disponible à l'url : [http://localhost:8082/](http://localhost:8082/)

## Documentation

Dans l'idéale il faudrait créer des inputs/output boundary pour avoir une belle documentation et ajouter les anotations pour swagger

Exemple : `PostBookController`
> * @OA\RequestBody(description="An example resource", @Model(type=BookRequest::class))
> * @OA\Response(response="200", description="An example resource", @Model(type=BookResponse::class))

Ne pas oublier les uses : 

> * use Nelmio\ApiDocBundle\Annotation\Model;
> * use OpenApi\Annotations as OA;

Dans le @Model mettre votre boundary d'entré ou de sortie


### Source

- [Site officiel](https://symfony.com/bundles/NelmioApiDocBundle/current/index.html)
- [Open api](https://www.openapis.org/)
