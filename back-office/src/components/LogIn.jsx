import { useState } from "react";

export const LogIn = ({ linkToAPI, setToken }) => {
    const [loginInput, setLoginInput] = useState('');
    const [passwordInput, setPasswordInput] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();

        //send login request for authentification
        //if user is admin, generate token
        fetch(`${linkToAPI}/auth`, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            credentials: 'include',
            body: JSON.stringify({
                login: loginInput,
                password: passwordInput
            })
        })
        .then((res) => res.json())
        .then(data => {
            if (data.status == 1) {
                //send request to verify token
                fetch(`${linkToAPI}/auth`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    credentials: 'include',
                    })
                    .then((res) => res.json())
                    .then(data => {
                        console.log(data);
                        if (data.status == 1) {
                          setToken(true);
                        } else console.log("user not authorized");
                    })            
                    .catch((err) => {
                        console.log(err)
                      })
            } else console.log("user not logged in");
        })            
        .catch((err) => {
            console.log(err)
          })
    }

    return (
        <div className="login">
            <h1>Admin authentication</h1>
            <form onSubmit={handleSubmit} className="login-form">
            <fieldset>
                <label htmlFor="login">Login</label>
                <input type="text" name="login" id="login" onChange={(e) => setLoginInput(e.target.value)} />
            </fieldset>
            
            <fieldset>
                <label htmlFor="password">Password</label>
                <input type="password" name="password" id="password" onChange={(e) => setPasswordInput(e.target.value)} />
            </fieldset>
            
            <input type="submit" value="Log In" className="button"/>
            </form>
        </div>
    )
}