
import ssl #secure socket layer for security
from smtplib import SMTP
from email.mime.text import MIMEText


def main():
    
    
    host = 'localhost'
    port = '8025'
    sender_email = "sender@email.com"
    receiver_email = "receiver@email.com"
    text = "Hey there,\nThis email is sent out from a Python SMTP Client."
    message = MIMEText(text, "plain")
    message["Subject"] = "Hi there from Python SMTP Client!"
    message["From"] = sender_email
    message["To"] = receiver_email
    
    context = ssl.create_default_context()
    with SMTP(host, port) as client:
        client.set_debuglevel(True)
        
        client.sendmail(sender_email, receiver_email, message.as_string())

if __name__ == '__main__':
    main()
