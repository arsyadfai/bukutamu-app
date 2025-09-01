import requests

# Gantilah dengan API Key dan Endpoint kamu
subscription_key = 'API_KEY_KAMU'
endpoint = 'https://<region>.api.cognitive.microsoft.com/face/v1.0/detect'

# Gantilah dengan URL atau file gambar yang ingin dianalisis
image_path = 'path_to_image.jpg'

# Header dan parameter yang diperlukan
headers = {
    'Content-Type': 'application/octet-stream',
    'Ocp-Apim-Subscription-Key': subscription_key
}

params = {
    'returnFaceId': 'true',
    'returnFaceLandmarks': 'false',
    'returnFaceAttributes': 'age,gender,emotion'
}

# Membaca gambar dan mengirimkan permintaan ke API
with open(image_path, 'rb') as image_file:
    response = requests.post(endpoint, headers=headers, params=params, data=image_file)

# Memeriksa respons
if response.status_code == 200:
    faces = response.json()
    for face in faces:
        print(f"Face ID: {face['faceId']}")
        print(f"Gender: {face['faceAttributes']['gender']}")
        print(f"Age: {face['faceAttributes']['age']}")
else:
    print("Error:", response.status_code, response.text)
