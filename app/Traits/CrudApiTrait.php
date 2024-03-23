<?php

namespace App\Traits;

trait CrudApiTrait
{
    protected $name;
    protected $command;

    public function get(array $query = [])
    {
        if ($this->connect()) {
            $data = $this->API->comm($this->command . "print", $query);
            cek_error($data);
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function show(string $id)
    {
        if ($this->connect()) {
            $data = $this->API->comm($this->command . "print", [
                '?.id' => $id
            ]);
            cek_error($data);
            $this->disconnect();
            return handle_data_edit($data);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function store(array $param)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "add", $param);
                return handle_data($data, 'Success Insert Data!');
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function update(array $param)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "set", $param);
                return handle_data($data, 'Success Update Data!');
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function destroy(string $id)
    {
        if ($this->connect()) {
            $data = $this->API->comm($this->command . "remove", [
                '.id' => $id
            ]);
            cek_error($data);
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }
}
