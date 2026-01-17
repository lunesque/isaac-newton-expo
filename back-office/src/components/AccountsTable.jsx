export const AccountsTable = ({ linkToAPI, data, modifications, setModifications }) => {
    if (!Array.isArray(data)) return null;
    let rowCounter = 1;

    const handleClick = (e) => {
        fetch(`${linkToAPI}/accounts/${e.target.getAttribute('acc')}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            credentials: 'include',
        })
        .then((res) => res.json())
        .then(data => {
            setModifications([...modifications, data]);
        })
    }

    
    return (
        <div className="table-container">
            <table className="accounts-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Login</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((account) => {
                        return (
                            <tr>
                                <td>{rowCounter++}</td>
                                <td>{account.login}</td>
                                <td>{account.first_name}</td>
                                <td>{account.last_name}</td>
                                <td>{account.email}</td>
                                <td><button className="button" onClick={handleClick} acc={account.id}>Delete</button></td>
                            </tr>
                        )
                    })}
                </tbody>
            </table>
        </div>
    )
}