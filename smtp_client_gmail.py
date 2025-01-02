import ssl
import argparse
from smtplib import SMTP_SSL
from email.mime.text import MIMEText  #extension of smtp for adding  multimedia and text types


def main():
    sender_email = "19aditidole@gmail.com"
    receiver_email = "19aditidole@gmail.com"
    host = "smtp.gmail.com"
    port = 465
    password = input("Type your password and press enter: ")
    text = """
        Hey there,
        This email is sent out from a Python SMTP Client.
        Cool, right?!
    """
    message = MIMEText(text, "plain") # 
    message["Subject"] = "Hi there from Python SMTP Client!"
    message["From"] = sender_email
    message["To"] = receiver_email
    
    context = ssl.create_default_context()
    with SMTP_SSL(host, port, context=context) as client:
        client.set_debuglevel(True)
        client.login(sender_email, password)
        client.sendmail(sender_email, receiver_email, message.as_string())

if __name__ == '__main__':
    main()