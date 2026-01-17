import { useEffect, useState } from "react";
import { AccountsTable } from "./AccountsTable";

export const Accounts = ({ linkToAPI }) => {
    const [modifications, setModifications] = useState([])

    const [accountsData, setAccountsData] = useState([]);

    useEffect(() => {
        fetch(`${linkToAPI}/accounts`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
            credentials: 'include',
        })
            .then(async (res) => {
                return await res.json()
            })
            .then((data) => {
                setAccountsData(data)
            })
    }, [modifications]);
        
    return (
        <div className="accounts">
            <h2>Manage accounts</h2>
            <AccountsTable linkToAPI={linkToAPI} data={accountsData} setModifications={setModifications} modifications={modifications} />
        </div>
    )
}