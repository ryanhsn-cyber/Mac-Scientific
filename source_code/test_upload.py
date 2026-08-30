import requests
from bs4 import BeautifulSoup
import io

url = "https://ms-bd.com/admin/login"
session = requests.Session()

# Get the login page to grab CSRF token
response = session.get(url)
soup = BeautifulSoup(response.text, 'html.parser')
token_tag = soup.find('input', {'name': '_token'})
if not token_tag:
    print("Could not find CSRF token on login page")
    exit(1)
token = token_tag['value']

# Login
login_data = {
    '_token': token,
    'login_email': 'admin@macscientific.com',
    'login_password': '12345678'
}
res = session.post(url, data=login_data)
if 'dashboard' not in res.url and 'home-page' not in res.url:
    print("Login failed. URL after login:", res.url)
    soup = BeautifulSoup(res.text, 'html.parser')
    alerts = soup.find_all('div', class_='alert')
    for a in alerts:
        print("LOGIN ALERT:", a.text.strip())
    exit(1)
print("Logged in successfully.")

# Get home page to get CSRF token
home_url = "https://ms-bd.com/admin/home-page"
res = session.get(home_url)
soup = BeautifulSoup(res.text, 'html.parser')
token_tag = soup.find('input', {'name': '_token'})
token = token_tag['value']

# Create a tiny 1x1 png image
png_data = b'\x89PNG\r\n\x1a\n\x00\x00\x00\rIHDR\x00\x00\x00\x01\x00\x00\x00\x01\x08\x06\x00\x00\x00\x1f\x15\xc4\x89\x00\x00\x00\nIDATx\x9cc\x00\x01\x00\x00\x05\x00\x01\r\n-\xb4\x00\x00\x00\x00IEND\xaeB`\x82'
file_obj = io.BytesIO(png_data)
file_obj.name = 'test_banner.png'

# Upload to highlight banner
upload_url = "https://ms-bd.com/admin/home-page/highlight/banner/update"
files = {'highlight_banner': ('test_banner.png', file_obj, 'image/png')}
data = {'_token': token}

res = session.post(upload_url, data=data, files=files)
print("Upload status code:", res.status_code)
# Get the response text to see if there is any error message in the session flash
soup = BeautifulSoup(res.text, 'html.parser')
alerts = soup.find_all('div', class_='alert')
for a in alerts:
    print("ALERT FOUND:", a.text.strip())

print("Done.")
