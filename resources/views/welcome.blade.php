<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    {{-- 生徒追加 --}}
    <form action="{{ route('student.create') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="名前">
        <input type="submit" value="生徒を追加する">
    </form>

    {{-- 部活の追加 --}}
    <form action="{{ route('club.create') }}" method="post">
        @csrf
        <input type="text" name="club" placeholder="部活">
        <input type="submit" value="部活を追加する">
    </form>

    {{-- 生徒一覧 foreach --}}
    <ul>
        @if ($students !== null)
            @foreach ($students as $student)
                <li>{{ $student->name }}</li>
                @foreach ($clubs as $club)
                    <form action="{{ route('member.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="student" value="{{ $student->id }}">
                        <input type="hidden" name="club" value="{{ $club->id }}">
                        <input type="submit" value="{{ $club->name }}">
                    </form>
                @endforeach
            @endforeach
        @endif
    </ul>


    {{-- 部員の一覧 --}}

    <ul>
        @foreach ($clubs as $club)

            <li>{{ $club->name }}
                <span>
                    @if ($club->approval === App\Models\Club::INSUFFICIENT)
                        人数不足
                    @elseif($club->approval === App\Models\Club::UNAPPROVED)
                        未承認
                        <form method="POST" action="{{ route('club.approval') }}">
                            @csrf
                            <input type="hidden" name="club_id" value="{{ $club->id }}">
                            <input type="submit" value="承認する">
                        </form>
                    @elseif($club->approval === App\Models\Club::APPROVED)
                        承認済み
                    @endif
                </span>
            </li>

            {{-- $club->studentsを一つの配列とみて回す --}}
            @foreach ($club->students as $club_student)
                <li style="list-style: none; display: inline;">{{ $club_student->name }}</li>
                <form action="{{ route('member.delete') }}" method="post" style="display: inline">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $club_student->id }}">
                    <input type="hidden" name="club_id" value="{{ $club->id }}">
                    <input type="submit" value="退部">
                </form>
            @endforeach

        @endforeach
    </ul>
    {{-- 部員の削除 --}}



    {{-- 部活の削除 --}}

    {{-- 承認未承認確認 --}}





</body>

</html>
