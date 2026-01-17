export const TicketsTable = ({ data }) => {
    if (!Array.isArray(data)) return null;
    let rowCounter = 1;

    return (
        <div className="table-container">
            <table className="tickets-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Unit price (in €)</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((ticket) => {
                        return (
                            <tr key={ticket.id}>
                                <td>{rowCounter++}</td>
                                <td>{ticket.title}</td>
                                <td>{ticket.description}</td>
                                <td>{ticket.unit_price}</td>
                            </tr>
                            )                
                    })}
                </tbody>
            </table>
        </div>
    )
}