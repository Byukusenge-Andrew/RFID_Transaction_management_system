import requests

# Define the URL to send the request to
url = "http://localhost/php_program/embedded/upload.php"

# Prepare the data to be sent in the POST request
data = {
    "customer": "John Doe",        
    "initial_balance": 100,         
    "transport_fare": 20           
}

# Send the POST request to the server with the data
response = requests.post(url, data=data)

# Print the response from the server
print(response.text)
