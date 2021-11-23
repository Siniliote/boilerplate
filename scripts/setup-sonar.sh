#!/bin/sh

echo "Configuration de SonarQube..."

while echo "$response" | grep -qv '"status":"UP"'; do
  response=$(curl http://localhost:9000/api/system/status 2> /dev/null)
done

curl -u admin:admin -X POST \
  http://localhost:9000/api/settings/set\?key\=sonar.forceAuthentication\&value\=false \
  2> /dev/null

echo "Done, visit http://localhost:9000"