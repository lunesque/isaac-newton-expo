export const Header = ({ setToken, linkToAPI }) => {
    const handleClick = () => {
        fetch(`${linkToAPI}/auth`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            credentials: 'include',
        })
            .then(async (res) => {
                return await res.json()
            })
            .then((response) => {
                console.log(response);
                if (response.token.status == 1) {
                    setToken(false);
                }
            })
    }
    return (
        <header>
            <h1>Isaac Newton expo back-office</h1>
            <button onClick={handleClick} className="button">Logout</button>
        </header>
    )
}