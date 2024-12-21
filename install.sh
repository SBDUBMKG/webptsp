# #!/bin/bash

# Step 1: Prompt the user for the service name
read -p "Enter the service name: " SERVICE_NAME

# Step 2: Build the Go binary
# go-assets-builder templates -o assets.go && 
# go get -d -v ./...
#go mod tidy
#go build -o "$SERVICE_NAME"

# Step 3: Generate a systemd service unit file
SERVICE_DESCRIPTION="My Go Application"
EXECUTABLE_PATH="$(pwd)/$SERVICE_NAME"
WORKING_DIRECTORY="$(pwd)"
USERNAME="$(whoami)"

SERVICE_UNIT="[Unit]
Description=$SERVICE_DESCRIPTION
Wants=network-online.target
After=network-online.target

[Service]
ExecStart=$EXECUTABLE_PATH
WorkingDirectory=$WORKING_DIRECTORY
User=$USERNAME
Group=$USERNAME
Restart=always
RestartSec=10


[Install]
WantedBy=multi-user.target"

echo "$SERVICE_UNIT" | sudo tee "/etc/systemd/system/$SERVICE_NAME.service"
# Enable and start the services
sudo systemctl enable "$SERVICE_NAME"
sudo systemctl start "$SERVICE_NAME"
