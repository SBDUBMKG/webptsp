#!/bin/bash

# Prompt the user for the service name to uninstall
read -p "Enter the service name to uninstall: " SERVICE_NAME

# Step 1: Stop and disable the services
sudo systemctl stop "$SERVICE_NAME"
sudo systemctl disable "$SERVICE_NAME"

# Step 2: Remove the service unit files
sudo rm "/etc/systemd/system/$SERVICE_NAME.service"

# Step 3: Reload systemd to apply changes
sudo systemctl daemon-reload

# Output status messages
echo "Uninstallation of $SERVICE_NAME completed."
