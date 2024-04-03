#!/bin/bash

echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++"
echo "+++++++++ Welcome to the LautlosLernen installation script ++++++++++"
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++"

echo ""
echo ""

while true; do
    read -p "Do you have installed Docker Desktop (y/n)?" docker_installed

    docker_installed=${docker_installed,,}

    if [[ "$docker_installed" == "n" || "$docker_installed" == "no" ]]; then
        echo "You need to install Docker Desktop."
        echo "Opening https://www.docker.com/products/docker-desktop/ ..."
        if command -v xdg-open &> /dev/null
        then
            xdg-open "https://www.docker.com/products/docker-desktop/"
        else
            echo "Error: xdg-open command not found. Cannot open URL."
            exit 1
        fi
        
        break
    elif [[ "$docker_installed" == "y" || "$docker_installed" == "yes" ]]; then
        echo "Perfect. The Docker will be set up now."
        docker-compose up
    else
        echo "Input not valid, please enter 'y' for yes or 'n' for no."
    fi
done