# Docker - Developers Love Docker.

--- 

> Docker rend le développement efficace et prévisible

## Docker

Docker élimine les tâches de configuration répétitives et banales et est utilisé tout au long du cycle de développement pour un développement d'applications rapide, facile et portable - bureau et cloud. 

La plate-forme complète de bout en bout de Docker comprend des interfaces utilisateur, des interfaces de ligne de commande, des API et une sécurité conçues pour fonctionner ensemble tout au long du cycle de vie de livraison des applications.

## Installation

[Get Started with Docker](https://www.docker.com/get-started)

## Usage - Makefile

> .mk\14_docker.mk

| Make                        | Description                                                                              | Référence                                                                   |
| --------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| `docker.start             ` | Build, (re)create, start, and attache to containers for a service (detached mode). | https://docs.docker.com/compose/reference/up/ |
| `docker.start.one         ` | Stop all projects running containers & Start current project. | |
| `docker.build             ` | Same `docker.start` command + build images before starting containers (detached mode). | https://docs.docker.com/compose/reference/up/ |
| `docker.build.force       ` | Stop, remove & rebuild current containers. | |
| `docker.stop              ` | Stop running containers without removing them. | https://docs.docker.com/compose/reference/stop/ |
| `docker.stop.all          ` | Stop all projects running containers without removing them. | https://docs.docker.com/compose/reference/stop/ |
| `docker.down              ` | [PROMPT yN] Stop containers and remove containers, networks, volumes, and images created by up. | https://docs.docker.com/compose/reference/down/ |
| `docker.list              ` | List containers. | https://docs.docker.com/engine/reference/commandline/ps/ |
| `docker.list.stopped      ` | List all stopped containers. | |
| `docker.remove            ` | [PROMPT yN] Stop & Remove service containers (only current project). | https://docs.docker.com/compose/reference/rm/ |
| `docker.remove.all        ` | [PROMPT yN] Remove all stopped service containers. | https://docs.docker.com/compose/reference/rm/ |
| `docker.images            ` | List images. | https://docs.docker.com/engine/reference/commandline/images/ |
| `docker.images.remove.all ` | [PROMPT yN] Remove all unused images (for all projects!). |
| `docker.clean             ` | [PROMPT yN] Remove unused data. | https://docs.docker.com/engine/reference/commandline/system_prune/ |
| `docker.env               ` | Show environment variables. | |
| `docker.ip                ` | Get ip Gateway.  | |
| `docker.ip.all            ` | List all containers ip. | |
| `docker.networks          ` | list networks. | https://docs.docker.com/engine/reference/commandline/network/ |
| `docker.logs              ` | Show logs. | |
| `docker.bash              ` | bash access. | |

## Fichier de configuration

> docker-compose.yml

Compose est un outil permettant de définir et d'exécuter des applications Docker multi-conteneurs. Avec Compose, vous utilisez un fichier YAML pour configurer les services de votre application.

Ensuite, avec une seule commande, vous créez et démarrez tous les services à partir de votre configuration.

Ici notre fichier de config docker-compose contient 3 containers

- php (8.1-RC6)
- nginx (1.21.3)
- postgresql (13)

> docker-compose.override.yml

La configuration dans le `docker-compose.override.yml` fichier est appliquée sur et en plus des valeurs dans le `docker-compose.yml` fichier.
Utilisé pour les containers orienté outils 

- swagger-ui
- adminer
- MailCatcher (TODO)

> infra/

Le dossier infra regroupe les configurations des containers 

Le `Dockerfile` est un document texte qui contient toutes les commandes qu'un utilisateur peut appeler en ligne de commande pour assembler une image.

### Source

- [WebSite](https://www.docker.com/)
