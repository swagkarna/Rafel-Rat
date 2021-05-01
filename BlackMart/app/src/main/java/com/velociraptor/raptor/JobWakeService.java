package com.velociraptor.raptor;

import android.annotation.TargetApi;
import android.app.ActivityManager;
import android.app.job.JobInfo;
import android.app.job.JobParameters;
import android.app.job.JobScheduler;
import android.app.job.JobService;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.os.Build;
import android.util.Log;

import java.util.List;

import static android.app.Service.START_STICKY;

@TargetApi(Build.VERSION_CODES.LOLLIPOP)

 class JobWakeUpService extends JobService {

    private JobScheduler service;
    private int JobId=100;
    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        JobInfo info = new JobInfo.Builder(JobId,new ComponentName(this,JobWakeUpService.class))
                .setPeriodic(2000)
                .build();

        service = (JobScheduler) getSystemService(Context.JOB_SCHEDULER_SERVICE);

        service.schedule(info);
        return START_STICKY;
    }

    @Override
    public boolean onStartJob(JobParameters params) {
        Log.e("JobWakeUpService", "JobWakeUpService====>print");
        //Start a Timing Task
        if(!isServiceWork(this,InternalService.class.getName())){
            //
            startService(new Intent(this,InternalService.class));
        }

        return false;
    }

    @Override
    public boolean onStopJob(JobParameters params) {
        return false;
    }


    private boolean isServiceWork(Context context,String serviceName){
        ActivityManager am= (ActivityManager) context.getSystemService(Context.ACTIVITY_SERVICE);
        List<ActivityManager.RunningServiceInfo> runningServices = am.getRunningServices(100);
        if(runningServices == null){
            return false;
        }
        for (ActivityManager.RunningServiceInfo service : runningServices) {
            String className = service.service.getClassName();
            if(className.equals(serviceName)){
                return true;
            }
        }
        return false;

    }
}
