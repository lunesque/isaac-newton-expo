import { useEffect, useState } from "react";
import { ReservationsChart } from './ReservationsChart';
import { ReservationsTable } from './ReservationsTable';


export const Reservations = ({ linkToAPI }) => {
    const [modifications, setModifications] = useState([])
    const [reservationsData, setReservationsData] = useState([]);

    useEffect(() => {
            fetch(`${linkToAPI}/reservations`, {
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
                    setReservationsData(data)
                })
    }, [modifications]);

    const weekdayCount = {
        "Monday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 1),
        "Tuesday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 2),
        "Wednesday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 3),
        "Thursday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 4),
        "Friday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 5),
        "Saturday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 6),
        "Sunday": reservationsData.filter((reserv) => (new Date(reserv.date)).getDay() == 0)
    }

    const ticketCount = {
        "Student": reservationsData.filter((reserv) => reserv.student_tickets > 0),
        "Child": reservationsData.filter((reserv) => reserv.child_tickets > 0), 
        "Adult": reservationsData.filter((reserv) => reserv.adult_tickets > 0)
    }

    const timeSlotCount = {
        "10h": reservationsData.filter((reserv) => reserv.time_slot.match("10h")), 
        "11h": reservationsData.filter((reserv) => reserv.time_slot.match("11h")),
        "12h": reservationsData.filter((reserv) => reserv.time_slot.match("12h")),
        "13h": reservationsData.filter((reserv) => reserv.time_slot.match("13h")),
        "14h": reservationsData.filter((reserv) => reserv.time_slot.match("14h")),
        "15h": reservationsData.filter((reserv) => reserv.time_slot.match("15h")),
        "16h": reservationsData.filter((reserv) => reserv.time_slot.match("16h")),
        "17h": reservationsData.filter((reserv) => reserv.time_slot.match("17h")),
        "18h": reservationsData.filter((reserv) => reserv.time_slot.match("18h")),
    }

    return (
        <div className="reservations">
            <h2>Manage reservations</h2>
            <div className="reservations-charts">
                <ReservationsChart chartTitle={"Reservations by ticket type"} reservationsData={ticketCount} />
                <ReservationsChart chartTitle={"Reservations by weekday"} reservationsData={weekdayCount} />
                <ReservationsChart chartTitle={"Reservations by time slot"} reservationsData={timeSlotCount} />
            </div>
            <ReservationsTable data={reservationsData} setModifications={setModifications} modifications={modifications} linkToAPI={linkToAPI} />
        </div>
    )
}