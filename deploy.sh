#!/bin/bash

# namespaces
kubectl apply -f ./k8s/namespaces.yaml

# secrets
kubectl apply -f ./k8s/secrets.yaml

# MySQL
kubectl apply -f ./k8s/mysql.yaml

# Application
kubectl apply -f ./k8s/application.yaml

# change context
# kubectl config set-context "$(kubectl config current-context)" --namespace=edent
