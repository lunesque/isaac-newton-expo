export const ReservationsTable = ({ data, setModifications, modifications, linkToAPI }) => {
    let rowCounter = 1;
    if (!Array.isArray(data)) return null;

    const handleClick = (e) => {
        fetch(`${linkToAPI}/reservations/${e.target.getAttribute('reserv')}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            credentials: 'include',
        })
        .then((res) => res.json())
        .then(data => {
            setModifications([...modifications, data]);
            console.log(data);
        })
    }
    
    return (
        <div className="table-container">
            <table className="reservations-table">
                <thead>
                    <tr>
                        <th rowSpan={2}>No</th>
                        <th rowSpan={2}>Date</th>
                        <th rowSpan={2}>Time Slot</th>
                        <th colSpan={3}>Quantity</th>
                        <th rowSpan={2}>Total (in €)</th>
                        <th rowSpan={2}>Account ID</th>
                        <th rowSpan={2}>Created At</th>
                        <th rowSpan={2}>Modified At</th>
                        <th rowSpan={2}>First name</th>
                        <th rowSpan={2}>Last name</th>
                        <th rowSpan={2}>Email</th>
                        <th rowSpan={2}></th>
                    </tr>
                    <tr>
                        <th>Child</th>
                        <th>Student</th>
                        <th>Adult</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((reservation) => {
                        return (
                            <tr key={reservation.id}>
                                <td>{rowCounter++}</td>
                                <td>{reservation.date}</td>
                                <td>{reservation.time_slot}</td>
                                <td>{reservation.child_tickets}</td>
                                <td>{reservation.student_tickets}</td>
                                <td>{reservation.adult_tickets}</td>
                                <td>{reservation.total}</td>
                                <td>{reservation.account_id}</td>
                                <td>{reservation.created_at}</td>
                                <td>{reservation.modified_at}</td>
                                <td>{reservation.first_name}</td>
                                <td>{reservation.last_name}</td>
                                <td>{reservation.email}</td>
                                <td><button className="button" onClick={handleClick} reserv={reservation.id} >Delete</button></td>
                            </tr>
                        )
                    })}
                </tbody>
            </table>
        </div>
    )
}