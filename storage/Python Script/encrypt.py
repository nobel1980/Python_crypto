from cryptography.fernet import Fernet
import sys
import json

# Fernet key generation
#key = Fernet.generate_key()
key = b'KEY HERE'
cipher_suite = Fernet(key)

# Function to encrypt JSON data
def encrypt_data(data):
    # Convert JSON data to bytes
    json_data = json.dumps(data).encode()
    
    # Encrypt the data
    ciphertext = cipher_suite.encrypt(json_data)
    
    return ciphertext

# Sample JSON data
json_data = {
    "bin": "002382437-0103",
    "deviceId": 37037
}

# Load JSON data from command line argument
#json_data = json.loads(sys.argv[1])

# Encrypt the JSON data
encrypted_data = encrypt_data(json_data)

print(encrypted_data)