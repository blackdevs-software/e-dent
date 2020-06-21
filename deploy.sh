#!/bin/bash

# namespace
kubectl apply -f ./k8s/namespace.yaml

# configmap
kubectl apply -f ./k8s/mysql-config.yaml
kubectl apply -f ./k8s/mysql-data.yaml

# secrets
kubectl apply -f ./k8s/secrets.yaml

# nginx ingress controller
INGRESS_INSTALLED=$(helm ls --all -n ingress-nginx 2> /dev/null | grep -ic "deployed")

if [ "$INGRESS_INSTALLED" -eq 0 ]; then
  # add ingress controller repo
  helm repo add nginx-stable https://helm.nginx.com/stable
  echo "repo added"

  # install ingress controller
  helm install ingress-nginx \
    -n ingress-nginx \
    --set controller.name="ingress-nginx" \
    --set controller.kind=deployment \
    --set controller.service.name=ingress-nginx \
    nginx-stable/nginx-ingress
  echo "release installed"
fi

# check if ingress controller is up and running
while [ "$(kubectl get pods -n ingress-nginx -l app=ingress-nginx | grep -ic "running")" -eq 0 ]; do
  echo "waiting for ingress controller pod to be running"
  sleep 2
done

# pvc
# kubectl apply -f ./k8s/mysql-pvc.yaml

# deployment and service mysql
kubectl apply -f ./k8s/mysql-statefulset.yaml
kubectl apply -f ./k8s/mysql-service.yaml

# deployment and service application
kubectl apply -f ./k8s/client-deployment.yaml
kubectl apply -f ./k8s/client-service.yaml

# ingress
kubectl apply -f ./k8s/ingress-service.yaml

# auto scaling pods
kubectl apply -f ./k8s/client-hpa.yaml

# change context
CURRENT_CONTEXT=$(kubectl config view | grep "current-context" | cut -d ":" -f2 | tr -d ' ')
kubectl config set-context "${CURRENT_CONTEXT}" --namespace=edent
