from cryptography.fernet import Fernet
import sys
import json

# Fernet key generation
#key = Fernet.generate_key()
key = b'KEY HERE'
cipher_suite = Fernet(key)


# Function to decode cipher data (You need to implement your own decryption logic here)
def decode_cipher_data(cipher_data):
    # Placeholder decryption logic
    decoded_data = cipher_data[::-1]  # Just a simple example of reversing the data
    return decoded_data

# Example cipher data
cipher_data = "b'gAAAAABmqhTNd71KSiwvA3IxULy8dNs96WIZRCfTuLbVe-64aDgG3uPSmr4RagwAtBs0yayvhbinG7CK-PhhmKEffhDL1Eh-mrvviKflboeD5waAU2QQQQGxcNJu8bCRD2BsLdHqhDSs'"

# Decode the cipher data
decoded_data = decode_cipher_data(cipher_data)

# Create a dictionary with the decoded data
data_dict = {
    "decoded_data": decoded_data
}

# Convert the dictionary to a JSON string
json_data = json.dumps(data_dict, indent=4)

# Print the JSON data
print(json_data)