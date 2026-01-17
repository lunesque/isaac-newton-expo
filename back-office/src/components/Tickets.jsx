import { useEffect, useState } from "react";
import { TicketsTable } from "./TicketsTable";

export const Tickets = ({ linkToAPI }) => {
    const [modifications, setModifications] = useState([])
    const [ticketsData, setTicketsData] = useState([]);

    useEffect(() => {
        fetch(`${linkToAPI}/tickets`, {
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
                setTicketsData(data)
            })
    }, [modifications]);
        
    return (
        <div className="tickets">
            <h2>Manage tickets</h2>
            <TicketsTable data={ticketsData} setModifications={setModifications} modifications={modifications}/>
        </div>
    )
}