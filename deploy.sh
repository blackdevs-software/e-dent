#!/bin/bash

(kubectl delete -f ./k8s 1> /dev/null 2>&1 && echo "Cleaning pods...") &
wait

# configmap
kubectl apply -f ./k8s/config.yaml
kubectl apply -f ./k8s/data.yaml

# secrets
kubectl apply -f ./k8s/secrets.yaml

# pvc
kubectl apply -f ./k8s/database-persistent-volume-claim.yaml

# nginx ingress controller
kubectl apply -f ./k8s/nginx-ingress-controller.yaml

# deployment and service mysql
kubectl apply -f ./k8s/mysql-deployment.yaml
kubectl apply -f ./k8s/mysql-cluster-ip-service.yaml

# deployment and service application
kubectl apply -f ./k8s/client-deployment.yaml
kubectl apply -f ./k8s/client-cluster-ip-service.yaml

# ingress
kubectl apply -f ./k8s/ingress-service.yaml

# auto scaling pods
kubectl apply -f ./k8s/hpa.yaml
