# Task

Hello, I allowed myself to make this task more difficult

## I created the following api

```python
login
# Through it, the administrator and the user can log in

register
# Through it, the user can create an account

register/sendCode
# Send the verification code to the customer on the phone upon registration

register/checkCode
# To verify the code that was sent and entered when registering

resetPassword
# To recover lost password

resetPassword/sendCode
# To send a verification code to the user's phone when recovering the password

resetPassword/checkCode
# To verify the code that was sent and entered when recovering the password

info profile
# View profile data

[changeName , changeName, changePhone, changePassword]
# To modify user data

refresh token

logout
```

## Packages are used

### jwt

Added for authentication


## 

## In order to write clean code, I did the following

```python
1 - create folder [Enums]
# in order to use the enumeration

2 - create folder [Helpers]
# I added my auxiliary functions inside it


3 - create folder [Services]
# It contains layers of code for the controller 
## In order to reduce the code used

3 - create folder [Services]
# It contains layers of code for the controller 

3 - create folder [Traits]
# In it any Traits will be created

4 - I created a private Trait for the relationships, a private Trait for the attribute,  and a private Trait for the scope in each model

# In order to keep the model clean in the front end
```

## operating instructions

```python
1 - Create a database named task
2 - Run it up [php artisan db:seed]
3 - Import API in Postman
https://grey-escape-334247.postman.co/workspace/blue-zone-~6d073457-7cf2-4ad9-b289-3a29bf4df6aa/collection/10084669-c1cb2d1c-65cd-4c72-a486-ba9dab09f716?action=share&creator=10084669
```

## Problems I encountered
```python
1 - Send email through tls connection
```
